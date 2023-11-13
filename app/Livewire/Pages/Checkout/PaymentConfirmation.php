<?php

namespace App\Livewire\Pages\Checkout;

use App\Livewire\Traits\WithBilling;
use App\Models\Order;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Order_QB;
use Livewire\Component;

class PaymentConfirmation extends Component
{
    use WithBilling;

    public $success = false;

    public function getOrderProperty(): Model|Order|Builder|_IH_Order_QB|null
    {
        return auth()->user()->orders()->latest()->where('status', '=', null)->first();
    }

    public function mount()
    {
        if (! $this->order) {
            return redirect('/dashboard');
        }

        //Yoco
        if (request('gateway') === 'yoco') {
            if (Hash::check(session('paymentId'), request('paymentId'))) {
                $this->createOrderPayment($this->order, $this->order->number, 'Yoco Online');
            }

            session()->forget('paymentId');

            $this->success = true;
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.checkout.payment-confirmation');
    }
}
