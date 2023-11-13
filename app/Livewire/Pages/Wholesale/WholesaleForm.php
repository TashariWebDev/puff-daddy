<?php

namespace App\Livewire\Pages\Wholesale;

use App\Livewire\Forms\CustomerUpdateForm;
use App\Livewire\Traits\WithNotifications;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class WholesaleForm extends Component
{
    use WithFileUploads;
    use WithNotifications;

    public CustomerUpdateForm $customerUpdateForm;

    public Customer $customer;

    public CustomerAddress $address;

    public $activeTab = 'business';

    #[Rule('required', 'file')]
    public $cipc_documents;

    #[Rule('required', 'file')]
    public $id_document;

    public array $photos = [];

    public $modal = false;

    public $selectedImage;

    public string $line_one;

    public string $line_two;

    public string $city;

    public string $suburb;

    public string $province;

    public string $postal_code;

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
        $this->address = auth()->user()->address->firstOrCreate();
    }

    public function updateCustomer(): void
    {
        $this->customerUpdateForm->update();
        $this->notify('Profile updated');
    }

    public function updatedCipcDocuments(): void
    {
        auth()->user()->update([
            'cipc_documents' => $this->cipc_documents->store(
                'uploads',
                'public'
            ),
        ]);

        $this->cipc_documents = auth()->user()->cipc_documents;

        $this->notify('Document saved');
    }

    public function updatedIdDocument(): void
    {
        $this->validate([
            'id_document' => ['required', 'file'],
        ]);

        auth()->user()->update([
            'id_document' => $this->id_document->store('uploads', 'public'),
        ]);

        $this->id_document = auth()->user()->id_document;

        $this->notify('Document saved');
    }

    public function updatedPhotos(): void
    {
        $this->validate(['photos' => ['required']]);

        foreach ($this->photos as $photo) {
            auth()->user()->businessImages()->create([
                'photo' => $photo->store('uploads', 'public'),
            ]);
        }

        $this->notify('Images saved');
    }

    public function submit(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        auth()->user()->update([
            'requested_wholesale_account' => true,
        ]);

        $this->notify('Application submitted');

        return redirect('/');
    }

    public function removeIdDocument(): void
    {
        if (file_exists('storage/'.auth()->user()->id_document)) {
            unlink('storage/'.auth()->user()->id_document);
        }

        auth()->user()->update([
            'id_document' => null,
        ]);

        $this->id_document = null;

        $this->notify('Document removed');
    }

    public function removeCipc(): void
    {
        if (file_exists('storage/'.auth()->user()->cipc_documents)) {
            unlink('storage/'.auth()->user()->cipc_documents);
        }

        auth()->user()->update([
            'cipc_documents' => null,
        ]);

        $this->cipc_documents = null;

        $this->notify('Document removed');
    }

    public function saveAddress(): void
    {
        $validatedData = $this->validate([
            'line_one' => 'required',
            'line_two' => 'sometimes',
            'city' => 'required',
            'suburb' => 'sometimes',
            'province' => 'required',
            'postal_code' => 'required',
        ]);

        auth()->user()->address->updateOrCreate($validatedData);

        $this->reset([
            'province',
            'line_one',
            'line_two',
            'suburb',
            'city',
            'postal_code',
        ]);

        $this->notify('Address added');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.wholesale.wholesale-form');
    }
}
