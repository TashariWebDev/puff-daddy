<?php

namespace App\View\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;

class BaseLayout extends Component
{
    public string $title = '';

    public string $description = '';

    public string $keywords = '';

    public function __construct(
        $title = '',
        $description = '',
        $keywords = ''
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('layouts.base');
    }
}
