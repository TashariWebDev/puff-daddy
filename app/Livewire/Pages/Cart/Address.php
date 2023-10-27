<?php

namespace App\Livewire\Pages\Cart;

use App\Livewire\Traits\WithNotifications;
use App\Models\CustomerAddress;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Address extends Component
{
    use WithNotifications;

    public array $addresses = [];

    public $selectedAddressId;

    public $selectedAddressProvince;

    public $deliveryOptions;

    public Order $order;

    public $delivery_id;

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

    #[Rule(['required'])]
    public $line_one;

    #[Rule(['sometimes'])]
    public $line_two;

    #[Rule(['required'])]
    public $suburb;

    #[Rule(['required'])]
    public $city;

    #[Rule(['required'])]
    public $province;

    #[Rule(['required'])]
    public $postal_code;

    public function mount(): void
    {
        $this->addresses = auth()->user()->addresses->all();

        $this->order = Order::where([
            'customer_id' => auth()->id(),
            'status' => null,
        ])
            ->withWhereHas('items.product')
            ->sole();

        if ($this->addresses) {
            $this->selectedAddressId = is_null($this->order->address_id)
                ? $this->addresses[0]['id'] : $this->order->address_id;

            $this->selectedAddressProvince = $this->addresses[0]['province'];

            $this->getDeliveryOptions();

            $this->delivery_id = is_null($this->order->delivery_type_id)
                ? $this->deliveryOptions[0]['id'] : $this->order->delivery_type_id;

        }
    }

    #[On('update-order')]
    public function getDeliveryOptions(): void
    {
        $this->deliveryOptions = Delivery::query()
            ->where('province', '=',
                $this->selectedAddressProvince)
            ->where('customer_type', '=', auth()->user()->type())
            ->orWhere('customer_type', '=', null)
            ->where('selectable', true)
            ->orderBy('price', 'asc')
            ->get();

    }

    public function updatedSelectedAddressId(): void
    {
        $address = CustomerAddress::find($this->selectedAddressId);

        $this->selectedAddressProvince = $address->province;

        $this->getDeliveryOptions();

        $this->delivery_id = $this->deliveryOptions[0]['id'];

        $this->dispatch('update-delivery');
    }

    #[On('update-delivery')]
    public function updatedDeliveryId(): void
    {
        $this->order->update([
            'address_id' => $this->selectedAddressId,
            'delivery_type_id' => $this->delivery_id,
            'delivery_charge' => Delivery::find($this->delivery_id)->getPrice($this->order->fresh()->getSubTotal()),
        ]);

        $this->dispatch('update-order');
    }

    public function store(): void
    {
        $validated = $this->validate();

        $address = auth()->user()->addresses()->create($validated);
        $this->addresses = auth()->user()->addresses->all();
        $this->selectedAddressId = $address->id;
        $this->selectedAddressProvince = $address->province;

        $this->getDeliveryOptions();

        $this->notify('address saved');
    }

    public function placeOrder(): void
    {
        $this->order->update([
            'status' => 'received',
        ]);

        $url = "payment?amount={$this->order->getTotal()}";

        $this->redirect($url, true);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.cart.address');
    }
}
