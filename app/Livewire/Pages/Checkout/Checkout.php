<?php

namespace App\Livewire\Pages\Checkout;

use App\Livewire\Traits\WithBilling;
use App\Livewire\Traits\WithNotifications;
use App\Models\Delivery;
use App\Models\Note;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Checkout extends Component
{
    use WithBilling;
    use WithNotifications;

    public $order;

    public $editDetails = false;

    public $editAddress = false;

    public $paymentOptions = false;

    public $deliveryPrice;

    public $rates;

    public $name;

    public $email;

    public $phone;

    public $company;

    public $vat_number;

    public $address_id;

    public $address;

    public $line_one;

    public $line_two;

    public $suburb;

    public $city;

    public $province;

    public $postal_code;

    public $type;

    public $deliveryOptions;

    public $ozowPostData;

    public $provinces = [
        'gauteng',
        'kwazulu natal',
        'limpopo',
        'mpumalanga',
        'north west',
        'free state',
        'northern cape',
        'western cape',
        'eastern cape',
    ];

    public $total;

    public $subtotal;

    public $body = '';

    public function mount()
    {
        $this->order = Order::where([
            'customer_id' => auth()->id(),
            'status' => null,
        ])
            ->withSum('items', 'qty')
            ->with('items.product')
            ->first();

        if (! $this->order) {
            return redirect('/');
        }

        if (! $this->order->items()->count()) {
            return redirect('/');
        }

        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->company = auth()->user()->company;
        $this->vat_number = auth()->user()->vat_number;

        $this->address = auth()->user()->address;

        if ($this->address) {
            $this->line_one = $this->address->line_one;
            $this->line_two = $this->address->line_two;
            $this->suburb = $this->address->suburb;
            $this->city = $this->address->city;
            $this->province = $this->address->province;
            $this->postal_code = $this->address->postal_code;
            $this->getDeliveryOptions();
        }

        $this->checkStockAvailability();

        $this->checkPriceChanges();

        $this->ozowPostData = $this->attemptPaymentWithOzow();

    }

    public function updateNote(): void
    {
        $this->validate([
            'body' => 'required',
        ]);

        Note::updateOrCreate([
            'order_id' => $this->order->id,
            'customer_id' => auth()->id(),
            'is_private' => false,
        ]);

        $this->notify('Your note has been updated.');
    }

    public function getDeliveryOptions(): void
    {

        $this->deliveryOptions = Delivery::query()
            ->where('province', '=',
                auth()->user()->address?->province)
            ->where('customer_type', '=',
                $this->order->customer->type())
            ->orWhere('customer_type', '=', null)
            ->where('selectable', true)
            ->orderBy('price', 'desc')
            ->get();

        $this->updateDelivery();
    }

    public function updateDelivery(): void
    {
        $selectedDeliveryOption = $this->deliveryOptions->first();

        if ($this->deliveryOptions->count() == 1) {
            $this->order->update([
                'delivery_type_id' => $this->deliveryOptions->first()->id,
            ]);
        }

        if ($this->order->delivery_type_id) {
            $selectedDeliveryOption = Delivery::find($this->order->delivery_type_id);
        }

        $this->order->delivery_charge = $selectedDeliveryOption->getPrice($this->order->getSubTotal());
        $this->order->delivery_type_id = $selectedDeliveryOption->id;
        $this->order->address_id = auth()->user()->address?->id;
        $this->order->save();

    }

    public function updateSelectedDelivery($deliveryId): Redirector|Application|RedirectResponse
    {
        $this->order->update([
            'delivery_type_id' => $deliveryId,
        ]);

        $this->updateDelivery();

        return redirect('/checkout');
    }

    public function updateAddress(): Redirector|Application|RedirectResponse
    {
        $validatedData = $this->validate([
            'line_one' => ['required'],
            'line_two' => ['nullable'],
            'suburb' => ['nullable'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
        ]);

        $this->address = auth()->user()->address()
            ->updateOrCreate(['customer_id' => auth()->id()], $validatedData);

        $this->getDeliveryOptions();

        $this->order->update([
            'delivery_type_id' => $this->deliveryOptions->first()->id,
            'address_id' => $this->address->id,
        ]);

        $this->updateDelivery();

        return redirect('/checkout');
    }

    public function checkPriceChanges(): void
    {
        $items = $this->order->items()->get();

        foreach ($items as $item) {
            $item->update([
                'price' => $item->product->getPrice(),
                'cost' => $item->product->cost,
            ]);
        }

    }

    public function checkStockAvailability(): void
    {
        $this->order->verifyIfStockIsAvailable();

        foreach ($this->order->items as $item) {
            if ($item->wasChanged('qty')) {
                $this->notify('Some of the items in your cart have been adjusted due to stock availability');
            }
        }

        $this->dispatch('update-order');
        $this->dispatch('update-cart');
    }

    public function updateUser(): void
    {
        $this->editDetails = true;

        $validatedData = $this->validate([
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique('customers', 'email')->ignore(auth()->id()),
            ],
            'phone' => ['required'],
            'company' => ['nullable'],
            'vat_number' => ['nullable'],
        ]);

        auth()->user()->update($validatedData);

        $this->editDetails = false;

        $this->notify('Your details have been updated');
    }

    public function placeOrder(): Redirector|Application|RedirectResponse
    {
        $this->order->verifyIfStockIsAvailable();

        foreach ($this->order->items as $item) {
            if ($item->wasChanged('qty')) {
                $this->notify(
                    'Some of the items in your cart have been adjusted due to stock availability'
                );

                $this->dispatch('update-order');
                $this->dispatch('update-cart');

                return back();
            }
        }

        $this->createUnpaidOrder($this->order);

        return redirect('order-confirmation');
    }

    public function attemptPaymentWithOzow(): array
    {
        return $this->getPostDataFromOzow(
            $this->order->getTotal(),
            $this->order->number,
        );
    }

    public function attemptPaymentWithYoco(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $paymentId = Str::random();

        session()->put('paymentId', $paymentId);

        $hashedId = Hash::make($paymentId);

        $checkout = Http::withToken(config('services.yoco.secret'))->post('https://payments.yoco.com/api/checkouts',
            [
                'amount' => to_cents($this->order->getTotal()),
                'currency' => 'ZAR',
                'cancelUrl' => config('app.url').'/checkout',
                'successUrl' => config('app.url').'/payment-confirmation?gateway=yoco&paymentId='
                    .$hashedId,
                'failureUrl' => config('app.url').'/checkout',
            ]);

        $response = json_decode($checkout, true);

        $redirectUrl = $response['redirectUrl'];

        return redirect($redirectUrl);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.checkout.checkout');
    }
}
