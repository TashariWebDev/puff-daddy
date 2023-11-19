<?php

namespace App\Models;

use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = ['placed_at' => 'datetime'];

    protected $with = ['items:id,order_id,qty,product_id'];

    //    Relationships
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_type_id');
    }

    public function sales_channel(): BelongsTo
    {
        return $this->belongsTo(SalesChannel::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(
            CustomerAddress::class,
            'address_id'
        )->withTrashed();
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class)->where('is_private', '=', false);
    }

    public function checkout_complete(): bool
    {
        return (int) $this->delivery_type_id * (int) $this->address_id > 1;
    }

    public function getTotal()
    {
        return $this->getSubTotal() + $this->delivery_charge;
    }

    public function getSubTotal(): float
    {
        return to_rands($this->items()->sum(DB::raw('price * qty')));
    }

    public function number(): Attribute
    {
        return new Attribute(get: fn () => 'INV00'.$this->attributes['id']);
    }

    public function deliveryCharge(): Attribute
    {
        return new Attribute(
            get: fn ($value) => (float) to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function inProgress($customer = null): Order|static
    {
        $customer = $customer ?? auth()->user();

        if (auth()->check()) {
            return self::firstOrCreate([
                'customer_id' => $customer->id,
                'status' => null,
                'processed_by' => null,
            ]);
        }

        return $this;
    }

    public function addItem(Product $product, int $qty = 1): Model
    {
        $item = $this->items()->firstOrCreate(
            [
                'product_id' => $product->id,
            ],
            [
                'product_id' => $product->id,
                'type' => 'product',
                'price' => $product->getPrice(),
                'cost' => $product->cost,
            ]
        );

        if ($qty > $product->qty()) {
            $item->update([
                'qty' => $product->qty(),
            ]);
        }

        if (($item->qty < $product->qty())) {
            $item->increment('qty', $qty);
        }

        return $item;

    }

    public function verifyIfStockIsAvailable(): RedirectResponse|static
    {
        foreach ($this->items as $item) {
            if ($item->qty > $item->product->qty()) {
                $item->qty = $item->product->qty();
                $item->save();
                if ($item->qty == 0) {
                    $this->remove($item);
                }
            }
        }

        return $this;
    }

    public function decreaseStock(): static
    {
        foreach ($this->items as $item) {
            $item->product->stocks()->updateOrCreate(
                [
                    'order_id' => $this->id,
                    'type' => 'invoice',
                    'reference' => $this->number,
                ],
                [
                    'order_id' => $this->id,
                    'type' => 'invoice',
                    'reference' => $this->number,
                    'qty' => 0 - $item->qty,
                    'cost' => $item->product->cost,
                ]
            );
        }

        return $this;
    }

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function print(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $view = view('templates.pdf.invoice', [
            'order' => $this->load('items'),
        ])->render();

        $url = storage_path("app/public/documents/$this->number.pdf");

        if (file_exists($url)) {
            unlink($url);
        }

        Browsershot::html($view)
            ->showBackground()
            ->ignoreHttpsErrors()
            ->emulateMedia('print')
            ->format('a4')
            ->paperSize(297, 210)
            ->setScreenshotType('pdf', 60)
            ->save($url);

        return redirect("/storage/documents/$this->number.pdf");
    }

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function download()
    {
        $view = view('templates.pdf.invoice', [
            'order' => $this->load('items'),
        ])->render();

        $url = storage_path("app/public/documents/$this->number.pdf");

        if (file_exists($url)) {
            unlink($url);
        }

        Browsershot::html($view)
            ->showBackground()
            ->ignoreHttpsErrors()
            ->emulateMedia('print')
            ->format('a4')
            ->paperSize(297, 210)
            ->setScreenshotType('pdf', 60)
            ->save($url);

        return Storage::disk('public')
            ->download('documents/'.$this->number.'.pdf');

    }

    public function scopeSearch($query, $terms): void
    {
        collect(explode(' ', $terms))
            ->filter()
            ->each(function ($term) use ($query) {
                $term = $term.'%';
                $query->where(function ($query) use ($term) {
                    $query
                        ->where('id', 'like', $term);
                });
            });
    }
}
