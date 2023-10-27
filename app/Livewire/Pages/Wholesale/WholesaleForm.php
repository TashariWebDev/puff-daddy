<?php

namespace App\Livewire\Pages\Wholesale;

use App\Livewire\Traits\WithNotifications;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class WholesaleForm extends Component
{
    use WithFileUploads;
    use WithNotifications;

    public Customer $customer;

    #[\Livewire\Attributes\Rule('required', 'file')]
    public $cipc_documents;

    #[\Livewire\Attributes\Rule('required', 'file')]
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

    public function rules(): array
    {
        return [
            'customer.name' => ['required'],
            'customer.email' => [
                'required',
                Rule::unique('customers', 'email')->ignore($this->customer->id),
            ],
            'customer.phone' => ['required'],
            'customer.alt_phone' => ['sometimes'],
            'customer.company' => ['required'],
            'customer.registered_company_name' => ['required'],
            'customer.vat_number' => ['sometimes'],
        ];
    }

    public function mount()
    {
        $this->customer = auth()->user();

        $this->customer->makeVisible(['cipc_documents', 'id_document']);
    }

    public function save(): void
    {
        $this->validate();
        $this->customer->save();

        $this->notify('Profile updated');
    }

    public function updatedCipcDocuments(): void
    {
        $this->customer->update([
            'cipc_documents' => $this->cipc_documents->store(
                'uploads',
                'public'
            ),
        ]);

        $this->cipc_documents = $this->customer->cipc_documents;

        $this->notify('Document saved');
    }

    public function updatedIdDocument(): void
    {
        $this->validate([
            'id_document' => ['required', 'file'],
        ]);

        $this->customer->update([
            'id_document' => $this->id_document->store('uploads', 'public'),
        ]);

        $this->id_document = $this->customer->id_document;

        $this->notify('Document saved');
    }

    public function updatedPhotos(): void
    {
        $this->validate(['photos' => ['required']]);

        foreach ($this->photos as $photo) {
            $this->customer->businessImages()->create([
                'photo' => $photo->store('uploads', 'public'),
            ]);
        }

        $this->notify('Images saved');
    }

    public function submit(
    ): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application {
        $this->customer->update([
            'requested_wholesale_account' => true,
        ]);

        $this->notify('Application submitted');

        return redirect('/');
    }

    public function removeIdDocument(): void
    {
        if (file_exists('storage/'.$this->customer->id_document)) {
            unlink('storage/'.$this->customer->id_document);
        }

        $this->customer->update([
            'id_document' => null,
        ]);

        $this->id_document = null;

        $this->notify('Document removed');
    }

    public function removeCipc(): void
    {
        if (file_exists('storage/'.$this->customer->cipc_documents)) {
            unlink('storage/'.$this->customer->cipc_documents);
        }

        $this->customer->update([
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

        $this->customer->addresses()->create($validatedData);

        $this->reset([
            'province',
            'line_one',
            'line_two',
            'suburb',
            'city',
            'postal_code',
        ]);

        $this->customer->refresh();

        $this->notify('Address added');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.wholesale.wholesale-form');
    }
}
