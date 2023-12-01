<div>
    
    
    <div>
        <livewire:pages.wholesale.requirements />
    </div>
    {{-- Business Info --}}
    <div class="mb-3">
        <div
            class="bg-white rounded-b-lg shadow"
        >
            
            <div class="p-4">
                <form wire:submit="submit">
                    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-2">
                        <div>
                            <div class="py-2">
                                <label
                                    for="name"
                                >Name</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="name"
                                        type="text"
                                        required
                                        wire:model.live="form.name"
                                    >
                                </div>
                                @error('form.name')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            
                            <div class="py-2">
                                <label
                                    for="email"
                                >Email</label>
                                <div class="mt-1">
                                    <input
                                        id="email"
                                        type="email"
                                        required
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        wire:model.live="form.email"
                                    >
                                </div>
                                @error('form.email')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            <div class="py-2">
                                <label
                                    for="phone"
                                >Mobile phone</label>
                                <div class="mt-1">
                                    <input
                                        id="phone"
                                        type="text"
                                        required
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        wire:model.live="form.phone"
                                    >
                                </div>
                                @error('form.phone')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            
                            <div class="py-2">
                                <label
                                    for="alt_phone"
                                >Alt phone (landline)</label>
                                <div class="mt-1">
                                    <input
                                        id="alt_phone"
                                        type="text"
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        wire:model.live="form.alt_phone"
                                    >
                                </div>
                                @error('form.alt_phone')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            
                            <div class="py-2">
                                <label
                                    for="registered_company_name"
                                >Company registered name</label>
                                <div class="mt-1">
                                    <input
                                        id="registered_company_name"
                                        type="text"
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        wire:model.live="form.registered_company_name"
                                    >
                                </div>
                                @error('form.registered_company_name')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            
                            <div class="py-2">
                                <label
                                    for="company"
                                >Company trading name</label>
                                <div class="mt-1">
                                    <input
                                        id="company"
                                        type="text"
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        wire:model.live="form.company"
                                    >
                                </div>
                                @error('form.company')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            
                            <div class="py-2">
                                <label
                                    for="vat_number"
                                >Company VAT Number (optional)</label>
                                <div class="mt-1">
                                    <input
                                        id="vat_number"
                                        type="text"
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        wire:model.live="form.vat_number"
                                    >
                                </div>
                                @error('form.vat_number')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="py-2">
                                <label
                                    for="line_one"
                                >Street Address</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="line_one"
                                        type="text"
                                        required
                                        wire:model.live="form.line_one"
                                    >
                                </div>
                                @error('form.line_one')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            <div class="py-2">
                                <label
                                    for="line_two"
                                >Building / Complex / Unit number</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="line_two"
                                        type="text"
                                        wire:model.live="form.line_two"
                                    >
                                </div>
                                @error('form.line_two')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            <div class="py-2">
                                <label
                                    for="suburb"
                                >Suburb</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="suburb"
                                        type="text"
                                        wire:model.live="form.suburb"
                                    >
                                </div>
                                @error('form.suburb')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            <div class="py-2">
                                <label
                                    for="city"
                                >City</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="city"
                                        type="text"
                                        required
                                        wire:model.live="form.city"
                                    >
                                </div>
                                @error('form.city')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            <div class="py-2">
                                <label
                                    for="province"
                                >Province</label>
                                <div class="mt-1">
                                    <select
                                        class="w-full rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                        id="province"
                                        wire:model.live="form.province"
                                    >
                                        <option value="">Choose</option>
                                        @foreach ($provinces as $province)
                                            <option
                                                class="capitalize"
                                                value="{{ $province }}"
                                            >
                                                {{ ucwords($province) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('form.province')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            
                            <div class="py-2">
                                <label
                                    for="postal_code"
                                >Postal code</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="postal_code"
                                        type="text"
                                        required
                                        wire:model.live="form.postal_code"
                                    >
                                </div>
                                @error('form.postal_code')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="py-2">
                                <label
                                    for="cipc_documents"
                                >Company CK Document</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="line_one"
                                        type="file"
                                        required
                                        wire:model.live="form.cipc_documents"
                                    >
                                </div>
                                @error('form.cipc_documents')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            
                            <div class="py-2">
                                <label
                                    for="id_document"
                                >ID Document</label>
                                <div class="mt-1">
                                    <input
                                        class="w-full"
                                        id="line_one"
                                        type="file"
                                        required
                                        wire:model.live="form.id_document"
                                    >
                                </div>
                                @error('form.id_document')
                                <div class="py-1">
                                    <p class="text-xs text-pink-600">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="flex justify-end mt-4">
                        <x-button
                            class="button-green"
                            wire:click="submit"
                        >Submit Application
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
