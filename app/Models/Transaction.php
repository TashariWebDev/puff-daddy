<?php

namespace App\Models;

use App\Jobs\CreateTransactionDocumentsJob;
use App\Jobs\UpdateCustomerRunningBalanceJob;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;

class Transaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            UpdateCustomerRunningBalanceJob::dispatch(
                $transaction->customer_id
            );
        });

        static::updated(function ($transaction) {
            UpdateCustomerRunningBalanceJob::dispatch(
                $transaction->customer_id
            );
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function amount(): Attribute
    {
        return new Attribute(
            get: fn ($value) => to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function runningBalance(): Attribute
    {
        return new Attribute(
            get: fn ($value) => to_rands($value),
            set: fn ($value) => to_cents($value)
        );
    }

    public function number(): Attribute
    {
        return new Attribute(get: fn () => 'CR00'.$this->attributes['id']);
    }

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function print()
    {
        $view = view('templates.pdf.transaction', [
            'transaction' => $this,
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

    public function post(
        Customer $customer,
        $amount,
        $type,
        $reference,
        $createdBy
    ): Model|Transaction {
        $transaction = $this->updateOrCreate([
            'customer_id' => $customer->id,
            'amount' => $amount,
            'reference' => $reference,
            'type' => $type,
            'created_by' => $createdBy,
            'date' => now(),
        ]);

        CreateTransactionDocumentsJob::dispatch($transaction->id);

        return $transaction;
    }
}
