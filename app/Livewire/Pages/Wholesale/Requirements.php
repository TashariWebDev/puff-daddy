<?php

namespace App\Livewire\Pages\Wholesale;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Requirements extends Component
{
    public $requirements = [];

    public function render(
    ): View|\Illuminate\Foundation\Application|Factory|Application {
        return view('livewire.pages.wholesale.requirements');
    }
}
