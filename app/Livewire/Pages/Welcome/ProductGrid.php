<?php

namespace App\Livewire\Pages\Welcome;

use App\Livewire\Traits\WithNotifications;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockAlert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use LaravelIdea\Helper\App\Models\_IH_Product_C;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductGrid extends Component
{
    use WithNotifications;
    use WithPagination;

    #[Url]
    public string $searchQuery = '';

    #[Url]
    public string $brandQuery = '';

    #[Url]
    public string $categoryQuery = '';

    #[Url]
    public bool $onlyInStock = false;

    protected array $queryString = [
        'searchQuery', 'brandQuery', 'categoryQuery', 'onlyInStock',
    ];

    public Collection $brands;

    public Collection $categories;

    public int $count = 0;

    public Order $order;

    public Product $selectedProduct;

    public int $qty = 1;

    public int $selectedProductQtyAvailable;

    #[Rule('required', 'email')]
    public string $email = '';

    public function mount(): void
    {
        $this->brands = Cache::remember(
            'brands',
            now()->addMinutes(5),
            function () {
                return Product::where('is_active', true)
                    ->orderBy('brand')
                    ->pluck('brand')
                    ->unique();
            }
        );
        $this->categories = Cache::remember(
            'categories',
            now()->addMinutes(5),
            function () {
                return Product::where('is_active', true)
                    ->orderBy('category')
                    ->pluck('category')
                    ->unique();
            }
        );
    }

    #[On('update-brand-filter')]
    public function brandFilter($brand)
    {
        $this->brandQuery = $brand;
    }

    #[On('update-category-filter')]
    public function categoryFilter($category)
    {
        $this->categoryQuery = $category;
    }

    #[On('update-product-status')]
    public function statusFilter($status): void
    {
        $this->onlyInStock = $status;
    }

    #[Computed]
    public function filteredProducts(
    ): _IH_Product_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array {
        return Product::query()
            ->with('features')
            ->onlyActive()
            ->withStockCount()
            ->withFilters(
                $this->searchQuery,
                $this->brandQuery,
                $this->categoryQuery
            )
            ->when($this->onlyInStock, function ($query) {
                $query->having('stocks_sum_qty', '>', 0);
            })
            ->paginate(18);

    }

    public function updatedSearchQuery(): void
    {
        $this->resetPage();
    }

    public function updatedBrandQuery(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryQuery(): void
    {
        $this->resetPage();
    }

    public function updatedOnlyInStock(): void
    {
        $this->resetPage();
    }

    #[On('clear-search-filters')]
    public function resetFilters(): void
    {
        $this->searchQuery = '';
        $this->brandQuery = '';
        $this->categoryQuery = '';
        $this->onlyInStock = false;
        $this->resetPage();

    }

    public function showStockAlert(Product $product): void
    {
        $this->selectedProduct = $product;

        if (auth()->check()) {
            $this->email = auth()->user()->email;
        }

        $this->dispatch('open-modal', name: 'stock-alerts');
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

    #[On('close-modal')]
    public function resetProduct(): void
    {
        $this->reset('selectedProduct');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.welcome.product-grid');
    }
}
