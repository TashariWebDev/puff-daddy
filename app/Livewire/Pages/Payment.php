<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\WithBilling;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class Payment extends Component
{
    use WithBilling;

    public $amount = 0;

    public $ozowPostData;

    public function mount()
    {
        $this->ozowPostData = $this->attemptPaymentWithOzow();
    }

    public function attemptPaymentWithOzow(): array
    {
        return $this->getPostDataFromOzow(
            $this->amount,
            auth()->user()->email.'/'.now()
        );
    }

    public function attemptPaymentWithPayflex(): Redirector|Application|RedirectResponse
    {
        $accessToken = $this->getAccessTokenFromPayflex();

        $getRedirectUrl = $this->redirectToPayflex(
            $accessToken,
            $this->amount,
            auth()->user()->email.'/'.now()
        );

        return redirect($getRedirectUrl);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.payment');
    }
}
