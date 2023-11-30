<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $with = ['features', 'stocks'];

    public function order_item(): hasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);
    }

    public function seoBrand(): string
    {
        return Str::slug(Str::lower($this->brand), '-');
    }

    public function seoName(): string
    {
        return Str::slug(Str::lower($this->name), '-');
    }

    //    public function product(): BelongsTo
    //    {
    //        return $this->belongsTo(Product::class);
    //    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'name');
    }

    public function product_collection(): BelongsTo
    {
        return $this->belongsTo(ProductCollection::class);
    }

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value
                ? config('app.admin_url').'/storage/'.$value
                : asset('/assets/no_image.jpeg')
        );
    }

    public function retailPrice(): Attribute
    {
        return new Attribute(
            get: fn ($value) => to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function wholesalePrice(): Attribute
    {
        return new Attribute(
            get: fn ($value) => to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function oldRetailPrice(): Attribute
    {
        return new Attribute(
            get: fn ($value) => to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function oldWholesalePrice(): Attribute
    {
        return new Attribute(
            get: fn ($value) => to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function getPrice($customer = null)
    {
        $user = $customer ?? auth()->user();

        if (auth()->check() && $user->is_wholesale) {
            return $this->wholesale_price;
        }

        return $this->retail_price;
    }

    public function getOldPrice()
    {
        if (auth()->check() && auth()->user()->is_wholesale) {
            return $this->old_wholesale_price;
        }

        return $this->old_retail_price;
    }

    public function qty()
    {
        return $this->stocks->where('sales_channel_id', '=', 1)->sum('qty');
    }

    public function hasPriceDrop(): bool
    {
        if (auth()->check()) {
            if (auth()->user()->is_wholesale) {
                if (
                    $this->old_wholesale_price > 0 &&
                    $this->old_wholesale_price > $this->wholesale_price
                ) {
                    return true;
                }
            }
        }

        if (
            $this->old_retail_price > 0 &&
            $this->old_retail_price > $this->retail_price
        ) {
            return true;
        }

        return false;
    }

    public function scopeAvailableToCustomerType($query)
    {
        if (auth()->check() && auth()->user()->is_wholesale) {
            return $query->where('available_to_wholesale', true);
        }

        if (auth()->check() && ! auth()->user()->is_wholesale) {
            return $query->where('available_to_retail', true);
        }

        return $query;

    }

    public function scopeOnlyActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        $query->withWhereHas('stocks', function ($query) {
            $query
                ->select(DB::raw('SUM(qty) AS available'))
                ->having('available', '>', 0);
        });

        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithStockCount($query)
    {
        return $query->withSum(
            [
                'stocks' => function ($query) {
                    $query->where('sales_channel_id', '=', 1);
                },
            ],
            'qty'
        );
    }

    public function scopeWithFilters($query, $search = '', $brand = '', $category = '')
    {

        return $query->when($search,
            fn ($query) => $query->search($search))
            ->when($brand,
                fn ($query
                ) => $query->whereBrand($brand)->orderBy('name'))
            ->when($category,
                fn ($query
                ) => $query->whereCategory($category)->orderBy('name'));
    }

    public function scopeSearch($query, $terms): void
    {
        collect(explode(' ', $terms))
            ->filter()
            ->each(function ($term) use ($query) {
                $term = $term.'%';
                $query->where(function ($query) use ($term) {
                    $query
                        ->where('brand', 'like', $term)
                        ->orWhere('name', 'like', $term)
                        ->orWhere('category', 'like', $term)
                        ->orWhere('sku', 'like', $term)
                        ->orWhereIn('id', function ($query) use ($term) {
                            $query
                                ->select('product_id')
                                ->from('features')
                                ->where('name', 'like', $term);
                        });
                });
            });
    }
}
