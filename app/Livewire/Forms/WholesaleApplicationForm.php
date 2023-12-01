<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Validation\Rule;
use Livewire\Form;

class WholesaleApplicationForm extends Form
{
    public CustomerAddress $address;

    public Customer $customer;

    public $name;

    public $email;

    public $phone;

    public $alt_phone;

    public $company;

    public $registered_company_name;

    public $vat_number;

    public $line_one = '';

    public $line_two = '';

    public $city = '';

    public $suburb = '';

    public $province = '';

    public $postal_code = '';

    public $id_document;

    public $cipc_documents;

    public function rules(): array
    {
        return [
            'line_one' => 'required',
            'line_two' => 'sometimes',
            'city' => 'required',
            'suburb' => 'sometimes',
            'province' => 'required',
            'postal_code' => 'required',
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique('customers',
                    'email')->ignore($this->customer->id),
            ],
            'phone' => ['required'],
            'alt_phone' => ['sometimes'],
            'company' => ['required'],
            'registered_company_name' => ['sometimes'],
            'vat_number' => ['sometimes'],
            'cipc_documents' => ['sometimes'],
            'id_document' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'company' => 'Your Company Name is required',
            'registered_company_name' => 'Your Registered Company Name is required',
            'id_document' => 'Your ID Document is required',
        ];
    }

    public function setCustomer(): void
    {
        $this->customer = auth()->user();

        $this->customer->makeVisible(['cipc_documents', 'id_document']);

        $this->name = $this->customer->name;
        $this->email = $this->customer->email;
        $this->phone = $this->customer->phone;
        $this->alt_phone = $this->customer->alt_phone;
        $this->company = $this->customer->company;
        $this->registered_company_name = $this->customer->registered_company_name;
        $this->vat_number = $this->customer->vat_number;

    }

    public function setAddress(): void
    {

        $this->address = auth()->user()->address ?? new CustomerAddress();

        $this->line_one = $this->address->line_one;
        $this->line_two = $this->address->line_two;
        $this->city = $this->address->city;
        $this->suburb = $this->address->suburb;
        $this->province = $this->address->province;
        $this->postal_code = $this->address->postal_code;
    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->customer->address->updateOrCreate([
            'user_id' => auth()->id(),
        ],
            [
                'line_one' => $validated['line_one'],
                'line_two' => $validated['line_two'],
                'city' => $validated['city'],
                'suburb' => $validated['suburb'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
            ]);

        $this->customer->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'alt_phone' => $validated['alt_phone'],
            'company' => $validated['company'],
            'registered_company_name' => $validated['registered_company_name'],
            'vat_number' => $validated['vat_number'],
            'id_document' => $this->id_document->store('uploads', 'public'),
            'cipc_documents' => $this->cipc_documents->store('uploads', 'public'),
            'requested_wholesale_account' => true,
        ]);
    }
}
