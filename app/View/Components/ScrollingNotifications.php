<?php

namespace App\View\Components;

use App\Models\MarketingNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class ScrollingNotifications extends Component
{
    public array $notifications;

    public function __construct()
    {
        $this->notifications = Cache::remember(
            'notification',
            now()->addMinutes(3),
            function () {
                return MarketingNotification::all()
                    ->pluck('body')
                    ->toArray();
            }
        );
    }

    public function render(): View
    {
        return view('components.marketing.scrolling-notifications');
    }
}
