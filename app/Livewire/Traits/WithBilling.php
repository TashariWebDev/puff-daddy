<?php

namespace App\Livewire\Traits;

use App\Mail\OrderConfirmedMail;
use App\Mail\OrderReceivedMail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;

trait WithBilling
{
    public function postTransaction(
        $customer,
        $amount,
        $type,
        $reference,
        $createdBy
    ): Transaction {
        return Transaction::updateOrCreate(
            [
                'customer_id' => $customer->id,
                'reference' => $reference,
                'type' => $type,
                'created_by' => $createdBy,
            ],
            [
                'customer_id' => $customer->id,
                'amount' => $amount,
                'reference' => $reference,
                'type' => $type,
                'created_by' => $createdBy,
                'date' => today(),
            ]
        );
    }

    public function processPayments(): void
    {
        if (request()->has('Status') && request('Status') == 'Complete') {
            $this->postTransaction(
                auth()->user(),
                0 - request('Amount'),
                'payment',
                request('TransactionId'),
                'ozow'
            );
        }

    }

    public function sendOrderEmails(): void
    {
        Mail::to(auth()->user()->email)->queue(new OrderConfirmedMail(auth()->user()));

        Mail::to(config('mail.from.address'))
            ->queue(new OrderReceivedMail(
                auth()->user(),
                $this->order)
            );
    }

    public function createOrderPayment($order, $reference, $createdBy): void
    {
        $order->decreaseStock();

        $order->customer->createInvoice($order);

        $order->customer->createPayment($order, $reference, $createdBy);

        $order->update([
            'status' => 'received',
            'created_at' => now(),
        ]);

    }

    public function createUnpaidOrder($order): void
    {
        $order->decreaseStock();
        $order->customer->createInvoice($order);

        $order->update([
            'status' => 'received',
            'created_at' => now(),
        ]);

        $order->items()->touch('created_at');

        $this->sendOrderEmails();

    }
}
