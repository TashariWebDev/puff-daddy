<?php

namespace App\View\Components\Pages\Cart;

use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Items extends Component
{
    public int $qty;

    public function __construct(public OrderItem $item)
    {
        $this->qty = $item->qty;
    }

    public function render(): View
    {
        return view('components.pages.cart.items');
    }
}
