<?php

namespace App\View\Components;

use App\Models\MarketingBanner;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class HeaderBanners extends Component
{
    public array $banners;

    public function __construct()
    {
        $this->banners = Cache::remember(
            'banners',
            now()->addMinutes(120),
            function () {
                return MarketingBanner::orderBy('order')
                    ->get()
                    ->pluck('image')
                    ->toArray();
            }
        );
    }

    public function render(): View
    {
        return view('components.marketing.header-banners');
    }
}
