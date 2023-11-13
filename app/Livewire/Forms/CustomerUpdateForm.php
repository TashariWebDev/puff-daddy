<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CustomerUpdateForm extends Form
{
    public Customer $customer;

    public $name;

    public $email;

    public $phone;

    public $alt_phone;

    public $company;

    public $registered_company_name;

    public $vat_number;

    public function rules(): array
    {
        return [
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
        ];
    }

    public function messages(): array
    {
        return [
            'company' => 'Your Company Name is required',
            'registered_company_name' => 'Your Registered Company Name is required',
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

    public function update(): void
    {
        $this->validate();
        $this->customer->update($this->all());
    }
}
