<?php

namespace App\Livewire\Pages\Cart;

use App\Livewire\Traits\WithNotifications;
use App\Models\OrderItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Items extends Component
{
    use WithNotifications;

    public OrderItem $item;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.cart.items');
    }
}
