<?php

namespace App\Livewire\Pages\Account;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Payment extends Component
{
    public $balance = 0;

    public $amount = 0;

    public function mount(): void
    {
        $this->balance = auth()->user()->getRunningBalance();
        $this->amount = $this->balance;
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.account.payment');
    }
}
