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

    #[On('remove-item')]
    public function remove($itemId): void
    {
        $item = OrderItem::find($itemId);
        $item->delete();

        $this->dispatch('update-delivery');

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

        $this->notify('qty updated');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->dispatch('update-order');

        return view('livewire.pages.cart.item-list', [
            'order' => Order::where([
                'customer_id' => auth()->id(),
                'status' => null,
            ])
                ->withWhereHas('items.product')
                ->sole(),
        ]);
    }
}
