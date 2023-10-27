<?php

namespace App\Livewire\Pages\Account\Transactions;

use App\Models\Credit;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Str;

class Table extends Component
{
    use WithPagination;

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function print(
        Transaction $transaction
    ): Redirector|Application|RedirectResponse {
        if ($transaction->type == 'invoice') {
            $order = Order::find(Str::after($transaction->reference, 'INV00'));

            return $order->print();
        }

        if ($transaction->type == 'credit') {
            $credit = Credit::find(Str::after($transaction->reference, 'CR00'));

            return $credit->print();
        }

        return $transaction->print();
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.account.transactions.table', [
            'transactions' => Transaction::query()
                ->whereBelongsTo(auth()->user())
                ->latest('id')
                ->paginate(5),
        ]);
    }
}
