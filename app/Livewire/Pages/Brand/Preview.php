<?php

namespace App\Livewire\Pages\Brand;

use App\Models\Brand;
use App\Models\LandingPage;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Preview extends Component
{
    public LandingPage $page;

    public function mount(LandingPage $page)
    {
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $brand = Brand::find($this->page->brand_id);

        return view('livewire.pages.brand.preview', [
            'products' => Product::query()
                ->active()
                ->withStockCount()
                ->where('brand', '=', $brand->name)
                ->get(),
        ])
            ->layout('layouts.base', [
                'title' => $this->page->title,
                'description' => $this->page->short_description,
                'keywords' => implode(' ,', Brand::all()->pluck('name')->toArray()),
            ]);
    }
}
