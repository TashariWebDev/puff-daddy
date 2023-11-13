<?php

namespace App\Livewire\Shared;

use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Footer extends Component
{
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.shared.footer', [
            'brands' => Brand::withWhereHas('page')->orderBy('name')->get(),
        ]);
    }
}
