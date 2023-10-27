<?php

namespace App\Livewire\Traits;

use App\Mail\OrderConfirmed;
use App\Mail\OrderReceived;
use App\Models\Transaction;
use GuzzleHttp\Promise\PromiseInterface;
use Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        if (request()->has('orderId')) {
            $accessToken = $this->getAccessTokenFromPayflex();

            $payflexOrder = $this->queryOrderWithPayflex(
                $accessToken,
                request('orderId')
            );

            if ($payflexOrder['orderStatus'] == 'Approved') {
                $this->postTransaction(
                    auth()->user(),
                    0 - $payflexOrder['amount'],
                    'payment',
                    $payflexOrder['orderId'],
                    'payflex'
                );
            }
        }
    }

    public function sendOrderEmails(): void
    {
        Mail::to(auth()->user()->email)->queue(new OrderConfirmed(auth()->id()));

        Mail::to(config('mail.from.address'))->queue(new OrderReceived(auth()->id()));
    }

    public function getAccessTokenFromPayflex()
    {
        return Http::withHeaders([
            'content-type' => 'application/json',
        ])->post(config('services.payflex.authUrl'), [
            'client_id' => config('services.payflex.clientId'),
            'client_secret' => config('services.payflex.secret'),
            'audience' => config('services.payflex.audience'),
            'grant_type' => 'client_credentials',
        ])['access_token'];
    }

    public function queryOrderWithPayflex(
        $accessToken,
        $orderId
    ): PromiseInterface|Response {
        return Http::retry(3, 100)
            ->withOptions([
                'verify' => false,
            ])
            ->withHeaders([
                'content-type' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ])
            ->get("https://api.payflex.co.za/order/{$orderId}");
    }

    public function redirectToPayflex(
        $accessToken,
        $amount,
        $reference = null
    ) {

        $response = Http::withOptions([
            'verify' => false,
        ])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ])
            ->post(config('services.payflex.baseUrl').'order/productSelect', [
                'amount' => number_format($amount, 2),
                'consumer' => [
                    'phoneNumber' => auth()->user()->phone,
                    'givenNames' => Str::before(auth()->user()->name, ' '),
                    'surname' => Str::after(auth()->user()->name, ' '),
                    'email' => auth()->user()->email,
                ],
                'merchant' => [
                    'redirectConfirmUrl' => config('services.payflex.successUrl'),
                    'redirectCancelUrl' => config('services.payflex.cancelUrl'),
                ],
                'merchantReference' => $reference,
            ]);

        return $response['redirectUrl'];
    }

    public function getPostDataFromOzow(
        $amount,
        $reference = null
    ): array {

        if (app()->environment('production')) {
            $isTest = 'false';
        } else {
            $isTest = 'true';
        }

        $data = [
            'siteCode' => config('services.ozow.siteCode'),
            'CountryCode' => 'ZA',
            'CurrencyCode' => 'ZAR',
            'Amount' => number_format(sprintf('%.2f', $amount), 2, '.', ''),
            'TransactionReference' => $reference,
            'BankReference' => 'Vape Crew',
            'CancelUrl' => config('services.ozow.cancelUrl'),
            'SuccessUrl' => config('services.ozow.successUrl'),
            'isTest' => $isTest,
        ];

        $output = '';

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
