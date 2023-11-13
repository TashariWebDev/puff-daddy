<?php

use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public $vat_number = '';

    public function mount(): void
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->company = auth()->user()->company ?? '';
        $this->vat_number = auth()->user()->vat_number;
    }

    public function updateProfileInformation(): void
    {
        $customer = auth()->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255', Rule::unique(Customer::class)->ignore($customer->id)
            ],
            'phone' => [
                'required', 'max:255', Rule::unique(Customer::class)->ignore($customer->id)
            ],
            'company' => ['sometimes', 'string', 'max:255'],
            'vat_number' => ['sometimes', 'max:255'],
        ]);

        $customer->fill($validated);

        if ($customer->isDirty('email')) {
            $customer->email_verified_at = null;
        }

        $customer->save();

        $this->dispatch('profile - updated', name: $customer->name);
    }

    public function sendVerification(): void
    {
        $customer = auth()->user();

        if ($customer->hasVerifiedEmail()) {
            $path = session('url . intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $customer->sendEmailVerificationNotification();

        session()->flash('status', 'verification - link - sent');
    }
}; ?>


<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address . ") }}
        </p>
    </header>

    <form
        wire:submit="updateProfileInformation"
        class="p-6 mt-6 space-y-6 bg-white rounded-lg"
    >
        <div>
            <x-input-label
                for="name"
                :value="__('Name')"
            />
            <x-text-input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                class="block mt-1 w-full"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        <div>
            <x-input-label
                for="email"
                :value="__('Email')"
            />
            <x-text-input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                class="block mt-1 w-full"
                required
                autocomplete="username"
            />
            <x-input-error
                class="mt - 2"
                :messages="$errors->get('email')"
            />
        </div>

        <div>
            <x-input-label
                for="phone"
                :value="__('Phone')"
            />
            <x-text-input
                wire:model="phone"
                id="phone"
                name="phone"
                type="text"
                class="block mt-1 w-full"
                required
                autocomplete="phone"
            />
            <x-input-error
                class="mt - 2"
                :messages="$errors->get('phone')"
            />
        </div>

        <div>
            <x-input-label
                for="company"
                :value="__('Company')"
            />
            <x-text-input
                wire:model="company"
                id="company"
                name="company"
                type="text"
                class="block mt-1 w-full"
            />
            <x-input-error
                class="mt - 2"
                :messages="$errors->get('company')"
            />
        </div>

        <div>
            <x-input-label
                for="vat_number"
                :value="__('VAT Number')"
            />
            <x-text-input
                wire:model="vat_number"
                id="vat_number"
                name="vat_number"
                type="text"
                class="block mt-1 w-full"
            />
            <x-input-error
                class="mt - 2"
                :messages="$errors->get('vat_number')"
            />
        </div>


        <div class="flex gap-4 items center">
            <x-button class="button-green">{{ __('Save') }}</x-button>

            <x-action-message
                class="mr-3"
                on="profile-updated"
            >
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
