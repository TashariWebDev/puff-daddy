<?php

use App\Livewire\Traits\WithNotifications;
use App\Models\CustomerAddress;
use Livewire\Volt\Component;

new class extends Component {
    use WithNotifications;

    public bool  $showForm = false;
    public array $addresses;

    public array $provinces = [
        'gauteng',
        'kwazulu natal',
        'limpopo',
        'mpumalanga',
        'north west',
        'free state',
        'northern cape',
        'western cape',
        'eastern cape'
    ];

    public int $selectedAddressId;

    public string  $line_one;
    public ?string $line_two = '';
    public string  $suburb;
    public string  $city;
    public string  $province;
    public string  $postal_code;


    public function mount(): void
    {
        $this->addresses = auth()->user()->addresses->all();
    }

    public function delete(CustomerAddress $address): void
    {
        $address->delete();
        $this->addresses = auth()->user()->addresses->all();
    }

    public function update(): void
    {
        $address = CustomerAddress::find($this->selectedAddressId);

        $validated = $this->validate([
            'line_one' => ['required', 'string', 'max:255'],
            'line_two' => ['sometimes', 'string', 'max:255'],
            'suburb' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:5'],
        ]);

        $address->update($validated);

        $this->showForm = false;

        $this->addresses = auth()->user()->addresses->all();

        $this->reset([
            'selectedAddressId', 'line_one', 'line_two', 'suburb', 'city', 'province', 'postal_code'
        ]);
    }

    public function store(): void
    {
        $customer = auth()->user();

        $validated = $this->validate([
            'line_one' => ['required', 'string', 'max:255'],
            'line_two' => ['sometimes', 'string', 'max:255'],
            'suburb' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:5'],
        ]);

        $customer->addresses()->create($validated);

        $this->reset(['line_one', 'line_two', 'suburb', 'city', 'province', 'postal_code']);
    }

    public function updatedSelectedAddressId(): void
    {
        $address = CustomerAddress::find($this->selectedAddressId);

        $this->line_one = $address->line_one;
        $this->line_two = $address->line_two;
        $this->suburb = $address->suburb;
        $this->city = $address->city;
        $this->province = $address->province;
        $this->postal_code = $address->postal_code;
    }
}; ?>

<div x-data="{showForm: @entangle('showForm')}">
  
  <div
      class="flex justify-end p-6 mb-2 w-full bg-white rounded-lg"
      x-show="!showForm"
  >
    <x-button
        class="button-green"
        x-on:click="showForm = ! showForm"
    >New Address
    </x-button>
  </div>
  
  <section
      class="p-4 bg-white shadow sm:p-8 sm:rounded-lg"
      x-show="showForm"
  >
    <header>
      <h2 class="text-lg font-medium text-gray-900">
        @if($selectedAddressId)
          {{ __('Update Address') }}
        @else
          {{ __('Add Address') }}
        @endif
      </h2>
    </header>
    
    <form
        @if($selectedAddressId) wire:submit="update"
        @else wire:submit="store"
        @endif
        class="mt-6 space-y-6"
    >
      
      <div>
        <x-input-label
            for="line_one"
            :value="__('Street Address')"
        />
        <x-text-input
            wire:model="line_one"
            id="line_one"
            name="line_one"
            type="text"
            class="block mt-1 w-full"
            required
            autofocus
        />
        <x-input-error
            class="mt-2"
            :messages="$errors->get('line_one')"
        />
      </div>
      
      <div>
        <x-input-label
            for="line_two"
            :value="__('Building / Apartment / Unit')"
        />
        <x-text-input
            wire:model="line_two"
            id="line_two"
            name="line_two"
            type="text"
            class="block mt-1 w-full"
        />
        <x-input-error
            class="mt-2"
            :messages="$errors->get('line_two')"
        />
      </div>
      
      <div>
        <x-input-label
            for="suburb"
            :value="__('Suburb')"
        />
        <x-text-input
            wire:model="suburb"
            id="suburb"
            name="suburb"
            type="text"
            class="block mt-1 w-full"
            required
        />
        <x-input-error
            class="mt-2"
            :messages="$errors->get('suburb')"
        />
      </div>
      
      <div>
        <x-input-label
            for="city"
            :value="__('City')"
        />
        <x-text-input
            wire:model="city"
            id="city"
            name="city"
            type="text"
            class="block mt-1 w-full"
            required
        />
        <x-input-error
            class="mt-2"
            :messages="$errors->get('city')"
        />
      </div>
      
      <div>
        <x-input-label
            for="province"
            :value="__('Province')"
        />
        <select
            wire:model="province"
            class="block mt-1 w-full capitalize rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
          <option value="">Choose</option>
          @foreach($provinces as $province)
            <option
                value="{{ $province }}"
                class="capitalize"
            >{{ $province }}</option>
          @endforeach
        </select>
        
        <x-input-error
            class="mt-2"
            :messages="$errors->get('province')"
        />
      </div>
      
      <div>
        <x-input-label
            for="postal_code"
            :value="__('Postal Code')"
        />
        <x-text-input
            wire:model="postal_code"
            id="postal_code"
            name="postal_code"
            type="text"
            class="block mt-1 w-full"
            required
        />
        <x-input-error
            class="mt-2"
            :messages="$errors->get('postal_code')"
        />
      </div>
      
      <div class="flex gap-4 items-center">
        <x-primary-button>
          @if($selectedAddressId)
            {{ __('Update') }}
          @else
            {{ __('Save') }}
          @endif
        </x-primary-button>
        
        <x-action-message
            class="mr-3"
            on="address-saved"
        >
          @if($selectedAddressId)
            {{ __('Updated.') }}
          @else
            {{ __('Saved.') }}
          @endif
        </x-action-message>
      </div>
    </form>
    
    <div class="mt-4">
      <button
          class="text-pink-600 hover:text-pink-700"
          x-on:click="showForm = false"
      >Cancel
      </button>
    </div>
  </section>
  
  
  <section x-show="!showForm">
    @foreach($addresses as $address)
      <div class="flex justify-between p-6 mb-2 bg-white rounded-lg">
        <p class="text-xs text-gray-600 capitalize whitespace-nowrap truncate">
          {{ $address->line_one }} {{ $address->line_two }} {{ $address->suburb }} {{ $address->city }} {{ $address->province }} {{ $address->postal_code }}
        </p>
        
        <div class="flex items-center space-x-3">
          <x-button
              class="flex justify-center items-center w-12 button-green"
              wire:click="$set('selectedAddressId','{{ $address->id  }}')"
              x-on:click="showForm = true"
          >
            <x-icons.edit class="w-4 h-4 text-white"/>
          </x-button>
          <x-button
              class="flex justify-center items-center w-12 button-green"
              wire:click="delete('{{ $address->id }}')"
              wire:confirm="Are you sure you want to delete this address?"
          >
            <x-icons.bin class="w-4 h-4 text-white"/>
          </x-button>
        </div>
      </div>
    @endforeach
  </section>
</div>
