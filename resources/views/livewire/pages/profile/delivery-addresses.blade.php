<?php

use App\Livewire\Traits\WithNotifications;
use App\Models\CustomerAddress;
use Livewire\Volt\Component;

new class extends Component {
    use WithNotifications;

    public CustomerAddress $address;

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


    public string $line_one;
    public ?string $line_two = '';
    public string $suburb;
    public string $city;
    public string $province;
    public string $postal_code;


    public function mount(): void
    {
        $this->address = auth()->user()->address ?? new CustomerAddress();
        $this->line_one = $this->address->line_one ?? '';
        $this->line_two = $this->address->line_two ?? '';
        $this->suburb = $this->address->suburb ?? '';
        $this->city = $this->address->city ?? '';
        $this->province = $this->address->province ?? '';
        $this->postal_code = $this->address->postal_code ?? '';
    }

    public function updateAddress()
    {
        $validatedData = $this->validate([
            'line_one' => ['required'],
            'line_two' => ['nullable'],
            'suburb' => ['nullable'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
        ]);

        $this->address = auth()->user()->address()
            ->updateOrCreate(['customer_id' => auth()->id()], $validatedData);

        $this->notify('updated');

    }
}; ?>

<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Delivery Address.
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your delivery address.
        </p>
    </header>

    <form wire:submit.prevent="updateAddress"
          class="p-6 mt-6 space-y-6 bg-white rounded-lg"
    >
        <div class="py-2">
            <label for="line_one">
                Street Address
            </label>
            <div class="mt-1">
                <input
                    type="text"
                    id="line_one"
                    class="w-full"
                    wire:model.defer="line_one"
                    wire:change.debounce.1500ms="updateAddress"
                />
            </div>
            @error('line_one')
            <div class="pt-1">
                <p class="text-xs text-red-700 uppercase">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="py-2">
            <label for="line_two">Apartment/Building & Unit No. (optional)</label>
            <div class="mt-1">
                <input
                    type="text"
                    id="line_two"
                    class="w-full"
                    wire:model.defer="line_two"
                    wire:change.debounce.1500ms="updateAddress"
                />
            </div>
            @error('line_two')
            <div class="pt-1">
                <p class="text-xs text-red-700 uppercase">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="py-2">
            <label for="suburb">
                Suburb
            </label>
            <div class="mt-1">
                <input
                    type="text"
                    id="suburb"
                    class="w-full"
                    wire:model.defer="suburb"
                    wire:change.debounce.1500ms="updateAddress"
                />
            </div>
            @error('suburb')
            <div class="pt-1">
                <p class="text-xs text-red-700 uppercase">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="py-2">
            <label for="city">
                City
            </label>
            <div class="mt-1">
                <input
                    type="text"
                    id="city"
                    class="w-full"
                    wire:model.defer="city"
                    wire:change.debounce.1500ms="updateAddress"
                />
            </div>
            @error('city')
            <div class="pt-1">
                <p class="text-xs text-red-700 uppercase">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="py-2">
            <label for="province">Province</label>
            <div class="mt-1 w-full">
                <label for="province"></label>
                <select
                    id="province"
                    name="province"
                    class="w-full text-sm bg-white rounded-md border focus:ring-1 focus:ring-teal-400 text-slate-800 placeholder-slate-300"
                    wire:model.defer="province"
                    wire:change.debounce.1500ms="updateAddress"
                >
                    <option value="">Select a province</option>
                    @foreach($provinces as $province)
                        <option
                            value="{{ $province }}"
                            class="capitalize"
                        >
                            {{ ucwords($province) }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('province')
            <div class="pt-1">
                <p class="text-xs text-red-700 uppercase">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="py-2">
            <label for="postal_code">
                Postal code
            </label>
            <div class="mt-1">
                <input
                    type="text"
                    id="postal_code"
                    class="w-full"
                    wire:model.defer="postal_code"
                    wire:change.live.debounce.1500ms="updateAddress"
                />
            </div>
            @error('postal_code')
            <div class="pt-1">
                <p class="text-xs text-red-700 uppercase">{{ $message }}</p>
            </div>
            @enderror
        </div>
    </form>
</section>
