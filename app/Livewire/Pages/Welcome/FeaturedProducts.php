<?php

namespace App\Livewire\Pages\Welcome;

use App\Livewire\Traits\WithNotifications;
use App\Models\Product;
use App\Models\StockAlert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Product_C;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FeaturedProducts extends Component
{
    use WithNotifications;

    public Product $selectedProduct;

    public int $qty = 1;

    public int $selectedProductQtyAvailable;

    #[Rule('required', 'email')]
    public string $email = '';

    #[Computed(persist: true)]
    public function featuredProducts(): _IH_Product_C|Collection|array
    {
        return Product::query()
            ->availableToCustomerType()
            ->onlyActive()
            ->withStockCount()
            ->inStock()
            ->where('is_featured', true)
            ->with('features')
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }

    public function showAddToCart(Product $product): void
    {
        if (! auth()->check()) {
            $this->redirect('/login');
        }

        $this->selectedProduct = $product;
        $this->selectedProductQtyAvailable = $product->stocks->sum('qty');

        $this->dispatch('open-modal', name: 'add-to-cart-modal');
    }

    public function saveStockAlert(): void
    {
        $this->validate();

        StockAlert::firstOrCreate([
            'product_id' => $this->selectedProduct->id,
            'email' => $this->email,
        ]);

        $this->reset(['email']);

        $this->notify('Stock alert set! You will be notified as soon as the stock arrives');

        $this->dispatch('close-modal', 'stock-alerts');
    }

    public function showStockAlert(Product $product): void
    {
        $this->selectedProduct = $product;

        if (auth()->check()) {
            $this->email = auth()->user()->email;
        }

        $this->dispatch('open-modal', name: 'stock-alerts');
    }

    #[On('close-modal')]
    public function resetProduct(): void
    {
        $this->reset('selectedProduct');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.welcome.featured-products');
    }
}
