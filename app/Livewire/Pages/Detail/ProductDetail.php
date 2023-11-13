<?php

namespace App\Livewire\Pages\Detail;

use App\Livewire\Traits\WithNotifications;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockAlert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Product_QB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductDetail extends Component
{
    use WithNotifications;

    public Order $order;

    public Product $selectedProduct;

    public int $qty = 1;

    public int $selectedProductQtyAvailable;

    public int $productId;

    public function mount($productId): void
    {
        $this->productId = $productId;
    }

    #[Computed]
    public function product(): Model|_IH_Product_QB|Builder|Product
    {
        return Product::where('id', '=', $this->productId)
            ->firstOrFail();
    }

    #[Computed]
    public function brand(): Model|_IH_Product_QB|Builder|Product
    {
        return Brand::where('name', '=', $this->product->brand)
            ->with('page')
            ->first();
    }

    public function updateProduct($productId): void
    {
        $this->productId = $productId;
    }

    public function showStockAlert($productId): void
    {
        //        $this->productId = $productId;
        $this->selectedProduct = $this->product;

        if (auth()->check()) {
            $this->email = auth()->user()->email;
        }

        $this->dispatch('open-modal', name: 'stock-alerts');
    }

    public function showAddToCart($productId): void
    {
        if (! auth()->check()) {
            $this->redirect('/login');
        }

        $this->selectedProduct = $this->product;

        $this->dispatch('open-modal', name: 'add-to-cart-modal');
    }

    public function saveStockAlert(): void
    {
        $this->validate();

        StockAlert::firstOrCreate([
            'product_id' => $this->product->id,
            'email' => $this->email,
        ]);

        $this->reset(['email']);

        $this->notify('Stock alert set! You will be notified as soon as the stock arrives');

        $this->dispatch('close-modal', 'stock-alerts');
    }

    //    #[On('close-modal')]
    //    public function resetProduct(): void
    //    {
    //        $this->reset('selectedProduct');
    //    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.detail.product-detail');
    }
}
