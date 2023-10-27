<?php

namespace App\Livewire\Pages\Cart;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Checkout extends Component
{
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.cart.checkout', [
            'order' => Order::where([
                'customer_id' => auth()->id(),
                'status' => null,
            ])
                ->withWhereHas('items.product')
                ->sole(),
        ]);
    }
}
