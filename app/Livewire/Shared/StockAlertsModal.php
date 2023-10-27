<?php

namespace App\Livewire\Shared;

use App\Livewire\Traits\WithNotifications;
use App\Models\Product;
use App\Models\StockAlert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StockAlertsModal extends Component
{
    use WithNotifications;

    public bool $showStockAlertModal = false;

    public int $productId;

    public Product $product;

    #[Rule('required', 'email')]
    public string $email = '';

    public function mount(Product $product): void
    {
        if (auth()->check()) {
            $this->email = auth()->user()->email;
        }
    }

    public function save(): void
    {
        $this->validate();

        StockAlert::firstOrCreate([
            'product_id' => $this->productId,
            'email' => $this->email,
        ]);

        $this->reset(['email']);

        $this->notify('Stock alert set! You will be notified as soon as the stock arrives');

        $this->showStockAlertModal = false;
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.shared.stock-alerts-modal');
    }
}
