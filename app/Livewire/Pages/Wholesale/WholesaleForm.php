<?php

namespace App\Livewire\Pages\Wholesale;

use App\Livewire\Forms\WholesaleApplicationForm;
use App\Livewire\Traits\WithNotifications;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithFileUploads;

class WholesaleForm extends Component
{
    use WithFileUploads;
    use WithNotifications;

    public WholesaleApplicationForm $form;

    public Customer $customer;

    public $activeTab = 'business';

    public array $provinces = [
        'gauteng',
        'kwazulu natal',
        'limpopo',
        'mpumalanga',
        'north west',
        'free state',
        'northern cape',
        'western cape',
        'eastern cape',
        'other',
    ];

    public function mount(): void
    {
        $this->form->setCustomer();
        $this->form->setAddress();
    }

    public function submit(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $this->form->update();

        $this->notify('Application submitted');

        return redirect('/');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.wholesale.wholesale-form');
    }
}
