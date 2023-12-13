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

        foreach ($order->items as $item) {
            $item->update([
                'created_at' => now(),
            ]);
        }

    }

    public function createUnpaidOrder($order): void
    {
        $order->decreaseStock();
        $order->customer->createInvoice($order);

        $order->update([
            'status' => 'received',
            'created_at' => now(),
        ]);

        foreach ($order->items as $item) {
            $item->update([
                'created_at' => now(),
            ]);
        }

    }

    //    Ozow Integration

    public function getPostDataFromOzow(
        $amount,
        $reference
    ): array {

        app()->environment('production') ? $isTest = 'false' : $isTest = 'true';

        $data = [
            'siteCode' => config('services.ozow.siteCode'),
            'CountryCode' => 'ZA',
            'CurrencyCode' => 'ZAR',
            'Amount' => number_format(sprintf('%.2f', $amount), 2, '.', ''),
            'TransactionReference' => $reference,
            'BankReference' => config(('app.name')),
            'CancelUrl' => config('app.url').'/checkout',
            'SuccessUrl' => config('app.url').'/payment-confirmation',
            'NotifyUrl' => config('app.url').'/order-confirmation',
            'isTest' => $isTest,
        ];

        $output = '';

        // concatenate variables as string
        foreach ($data as $key => $val) {
            if (! empty($val)) {
                $output .= trim($val);
            }
        }

        $string = strtolower($output.config('services.ozow.privateKey'));
        $data['HashCheck'] = hash('SHA512', $string);

        return $data;
    }
}
