<?php

namespace App\Models;

use App\Jobs\CreateTransactionDocumentsJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'alt_phone',
        'company',
        'registered_company_name',
        'vat_number',
        'is_wholesale',
        'password',
        'salesperson_id',
        'requested_wholesale_account',
        'id_document',
        'cipc_documents',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'id_document',
        'cipc_documents',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isWholesale(): string
    {
        return ! $this->is_wholesale ? '' : '(wholesale)';
    }

    public function type(): string
    {
        return (bool) ! $this->is_wholesale ? 'retail' : 'wholesale';
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(CustomerAddress::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function latestTransaction(): HasOne
    {
        return $this->hasOne(Transaction::class)->latestOfMany();
    }

    public function businessImages(): HasMany
    {
        return $this->hasMany(CustomerBusinessImage::class);
    }

    public function getRunningBalance()
    {
        if ($this->transactions()->count() == 1) {
            $transaction = $this->transactions()->first();

            if ($transaction->running_balance == 0) {
                return $transaction->amount;
            }
        }

        return $this->latestTransaction->running_balance ?? 0;
    }

    public function createInvoice(Order $order): Model|Transaction
    {
        $transaction = $this->transactions()->updateOrCreate(
            [
                'reference' => $order->number,
                'type' => 'invoice',
                'created_by' => auth()->user()->name,
            ],
            [
                'reference' => $order->number,
                'type' => 'invoice',
                'amount' => $order->fresh()->getTotal(),
                'created_by' => auth()->user()->name,
            ]
        );

        CreateTransactionDocumentsJob::dispatch($transaction->id);

        return $transaction;
    }

    public function createPayment(
        Order $order,
        $reference,
        $createdBy
    ): Model|Transaction {
        $transaction = $this->transactions()->updateOrCreate(
            [
                'reference' => $reference,
                'type' => 'payment',
                'created_by' => $createdBy,
            ],
            [
                'reference' => $reference,
                'type' => 'payment',
                'amount' => 0 - $order->getTotal(),
                'created_by' => $createdBy,
            ]
        );

        CreateTransactionDocumentsJob::dispatch($transaction->id);

        return $transaction;
    }

    public function createManualPayment(
        $reference,
        $amount,
        $createdBy
    ): Model|Transaction {
        $transaction = $this->transactions()->updateOrCreate(
            [
                'reference' => $reference,
                'type' => 'payment',
                'amount' => 0 - $amount,
                'created_by' => $createdBy,
            ],
            [
                'reference' => $reference,
                'type' => 'payment',
                'amount' => 0 - $amount,
                'created_by' => $createdBy,
            ]
        );

        CreateTransactionDocumentsJob::dispatch($transaction->id);

        return $transaction;
    }

    public function createDebit($reference, $amount, $createdBy): Transaction
    {
        $transaction = $this->transactions()->updateOrCreate(
            [
                'reference' => $reference,
                'type' => 'debit',
                'amount' => $amount,
                'created_by' => $createdBy,
            ],
            [
                'reference' => $reference,
                'type' => 'debit',
                'amount' => $amount,
                'created_by' => $createdBy,
            ]
        );

        CreateTransactionDocumentsJob::dispatch($transaction->id);

        return $transaction;
    }

    public function createCredit(Credit $credit, $reference): Model|Transaction
    {
        $transaction = $this->transactions()->updateOrCreate(
            [
                'reference' => $reference,
                'type' => 'credit',
                'amount' => $credit->getTotal(),
                'created_by' => auth()->user(),
            ],
            [
                'reference' => $reference,
                'type' => 'credit',
                'amount' => $credit->getTotal(),
                'created_by' => auth()->user(),
            ]
        );

        CreateTransactionDocumentsJob::dispatch($transaction->id);

        return $transaction;
    }
}
