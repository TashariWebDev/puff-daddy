<?php

namespace App\Livewire\Shared;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductFilter extends Component
{
    public array $brands = [];

    public array $categories = [];

    public string $selectedBrand = '';

    public string $selectedCategory = '';

    public bool $status = false;

    public function mount(): void
    {
        $this->brands = Product::where('is_active', true)
            ->orderBy('brand')
            ->pluck('brand')
            ->unique()
            ->toArray();

        $this->categories = Product::where('is_active', true)
            ->orderBy('category')
            ->pluck('category')
            ->unique()
            ->toArray();
    }

    public function updatedStatus(): void
    {
        $this->dispatch('update-product-status', $this->status);
    }

    public function updatedSelectedBrand(): void
    {
        $this->dispatch('update-brand-filter', $this->selectedBrand);
    }

    public function updatedSelectedCategory(): void
    {
        $this->dispatch('update-category-filter', $this->selectedCategory);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.shared.product-filter');
    }
}
