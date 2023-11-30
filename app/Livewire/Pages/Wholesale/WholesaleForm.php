<?php

namespace App\Livewire\Pages\Wholesale;

use App\Livewire\Forms\CustomerAddressUpdateForm;
use App\Livewire\Forms\CustomerUpdateForm;
use App\Livewire\Forms\DocumentForm;
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

    public CustomerUpdateForm $customerUpdateForm;

    public CustomerAddressUpdateForm $customerAddressUpdateForm;

    public DocumentForm $customerDocumentForm;

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
        $this->customerUpdateForm->setCustomer();
        $this->customerDocumentForm->setCustomer();
        $this->customerAddressUpdateForm->setAddress();
    }

    public function updateCustomer(): void
    {
        $this->customerUpdateForm->update();
        $this->notify('Profile updated');
    }

    public function updateAddress(): void
    {
        $this->customerAddressUpdateForm->update();
        $this->notify('Address updated');

    }

    public function updateCompanyDocuments(): void
    {
        $this->customerDocumentForm->update();
        $this->notify('Documents uploaded');

    }

    public function submit(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        auth()->user()->update([
            'requested_wholesale_account' => true,
        ]);

        $this->notify('Application submitted');

        return redirect('/');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.wholesale.wholesale-form');
    }
}
