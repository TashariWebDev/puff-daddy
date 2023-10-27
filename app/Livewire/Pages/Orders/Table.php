<?php

namespace App\Livewire\Pages\Orders;

use App\Livewire\Traits\WithNotifications;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Table extends Component
{
    use WithNotifications;
    use WithPagination;

    public $searchQuery = '';

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function print(Order $order): void
    {
        $order->print();
    }

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function download(Order $order): StreamedResponse
    {
        if (! Storage::disk('public')->exists("documents/$order->number.pdf")) {
            $order->download();
        }

        if (Storage::disk('public')->exists("documents/$order->number.pdf")) {
            return Storage::disk('public')->download('documents/'.$order->number.'.pdf');
        }

    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.orders.table', [
            'orders' => Order::whereBelongsTo(auth()->user())
                ->whereNotNull('status')
                ->latest()
                ->search($this->searchQuery)
                ->paginate(),
        ]);
    }
}
