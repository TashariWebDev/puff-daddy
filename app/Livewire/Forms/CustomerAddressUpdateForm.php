<?php

namespace App\Livewire\Forms;

use App\Models\CustomerAddress;
use Livewire\Form;

class CustomerAddressUpdateForm extends Form
{
    public CustomerAddress $address;

    public $line_one = '';

    public $line_two = '';

    public $city = '';

    public $suburb = '';

    public $province = '';

    public $postal_code = '';

    public function rules(): array
    {
        return [
            'line_one' => 'required',
            'line_two' => 'sometimes',
            'city' => 'required',
            'suburb' => 'sometimes',
            'province' => 'required',
            'postal_code' => 'required',
        ];
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
        $validated['customer_id'] = auth()->id();

        $this->address->updateOrCreate($validated);
    }
}
