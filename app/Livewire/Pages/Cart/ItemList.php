<?php

namespace App\Livewire\Pages\Cart;

use App\Livewire\Traits\WithNotifications;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ItemList extends Component
{
    use WithNotifications;

    public $order;

    public function mount(): void
    {
        $this->setCart();
    }

    #[On('remove-item')]
    public function remove($itemId): void
    {
        $item = OrderItem::find($itemId);
        $item->delete();

        $this->dispatch('update-delivery');
        $this->setCart();

        $this->notify('item removed');
    }

    #[On('update-qty')]
    public function updateQty($itemId, $qty): void
    {
        $item = OrderItem::find($itemId);

        $preventNegativeQty = $qty <= 0 ? 1 : $qty;

        $newQty = $preventNegativeQty > $item->product->qty() ? $item->product->qty() :
            $preventNegativeQty;

        $item->update(['qty' => $newQty]);

        $this->dispatch('update-delivery');

        $this->dispatch('update-order');

        $this->notify('qty updated');
    }

    public function setCart()
    {
        $this->order = Order::where([
            'customer_id' => auth()->id(),
            'status' => null,
        ])
            ->withSum('items', 'qty')
            ->with('items.product')
            ->latest()
            ->first();

        if (! $this->order) {
            return redirect('/');
        }

        if (! $this->order->items()->count()) {
            return redirect('/');
        }

        $this->checkStockAvailability();

        $this->checkPriceChanges();
    }

    public function checkStockAvailability(): void
    {
        $this->order->verifyIfStockIsAvailable();

        foreach ($this->order->items as $item) {
            if ($item->wasChanged('qty')) {
                $this->notify('Some of the items in your cart have been adjusted due to stock availability');
                $this->notify('Some of the items in your cart have been adjusted due to stock availability');
            }
        }

        $this->dispatch('update-order');
        $this->dispatch('update-cart');
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

        $this->dispatch('update-order');
        $this->dispatch('update-cart');
    }

    #[On('update-cart')]
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.cart.item-list', [
            'order' => $this->order,
        ]);
    }
}
