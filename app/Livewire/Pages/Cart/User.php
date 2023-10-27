<?php

namespace App\Livewire\Pages\Cart;

use App\Livewire\Traits\WithNotifications;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class User extends Component
{
    use WithNotifications;

    public Customer $customer;

    public string $name;

    public string $phone;

    public string $email;

    public string $company;

    public $vat_number;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => [
                'required', 'string',
                Rule::unique('customers', 'phone')->ignore($this->customer->id),
            ],
            'email' => [
                'required', 'string',
                Rule::unique('customers', 'email')->ignore($this->customer->id),
            ],
            'company' => ['nullable', 'string'],
            'vat_number' => ['nullable', 'string'],
        ];
    }

    public function mount(): void
    {
        $this->customer = auth()->user();
        $this->name = $this->customer->name;
        $this->phone = $this->customer->phone;
        $this->email = $this->customer->email;
        $this->company = $this->customer->company;
        $this->vat_number = $this->customer->vat_number;
    }

    public function updated(): void
    {
        $validated = $this->validate();

        auth()->user()->update($validated);

        $this->notify('details updated');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.cart.user');
    }
}
