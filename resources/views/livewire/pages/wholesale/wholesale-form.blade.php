<div>
    
    {{-- Business Info --}}
    <div class="mb-3">
        <div
            class="bg-white rounded-b-lg shadow"
        >
            <button
                class="block p-2 w-full text-left text-white bg-black border-t shadow"
                wire:click="$set('activeTab','business')"
            >
                <h3 class="text-lg font-medium leading-6">Business & contact Information</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-300">
                    Kindly supply us with your business and contact info.
                </p>
            </button>
            
            @if($activeTab === 'business')
                <div class="p-4">
                    <form wire:submit="updateCustomer">
                        
                        <div class="py-2">
                            <label
                                for="name"
                            >Name</label>
                            <div class="mt-1">
                                <input
                                    id="name"
                                    type="text"
                                    required
                                    wire:model.live="customerUpdateForm.name"
                                    placeholder="John Doe"
                                >
                            </div>
                            @error('customerUpdateForm.name')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    wire:model.live="customerUpdateForm.email"
                                    placeholder="vape@nosmoking.com"
                                >
                            </div>
                            @error('customerUpdateForm.email')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    wire:model.live="customerUpdateForm.phone"
                                    placeholder="081 911 9111"
                                >
                            </div>
                            @error('customerUpdateForm.phone')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    wire:model.live="customerUpdateForm.alt_phone"
                                    placeholder="0119119111"
                                >
                            </div>
                            @error('customerUpdateForm.alt_phone')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    wire:model.live="customerUpdateForm.registered_company_name"
                                    placeholder="Joe's Vapes PTY Ltd"
                                >
                            </div>
                            @error('customerUpdateForm.registered_company_name')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    wire:model.live="customerUpdateForm.company"
                                    placeholder="Joe's Vapes"
                                >
                            </div>
                            @error('customerUpdateForm.company')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    wire:model.live="customerUpdateForm.vat_number"
                                    placeholder="123456789"
                                >
                            </div>
                            @error('customerUpdateForm.vat_number')
                            <div class="py-1">
                                <p class="text-xs text-pink-600">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end items-center px-6 pb-10">
                            <x-button class="w-1/5 button-green">
                                Save
                            </x-button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    
    {{-- Address Info --}}
    <div class="mb-3">
        <div
            class="bg-white rounded-b-lg shadow"
        >
            <button
                class="block p-2 w-full text-left text-white bg-black border-t shadow"
                wire:click="$set('activeTab','address')"
            >
                <h3 class="text-lg">Delivery Addresses</h3>
                <p class="text-xs text-gray-300">Add all your delivery addresses</p>
            </button>
            
            @if($activeTab === 'address')
                <div class="p-4">
                    <form wire:submit.prevent="updateAddress">
                        
                        <div class="py-2">
                            <label
                                for="line_one"
                            >Street Address</label>
                            <div class="mt-1">
                                <input
                                    id="line_one"
                                    type="text"
                                    required
                                    wire:model.live="customerAddressUpdateForm.line_one"
                                    placeholder="10 John Doe Street"
                                >
                            </div>
                            @error('customerAddressUpdateForm.line_one')
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
                                    id="line_two"
                                    type="text"
                                    wire:model.live="customerAddressUpdateForm.line_two"
                                    placeholder="10 The Apartments"
                                >
                            </div>
                            @error('customerAddressUpdateForm.line_two')
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
                                    id="suburb"
                                    type="text"
                                    wire:model.live="customerAddressUpdateForm.suburb"
                                    placeholder="The Burbs"
                                >
                            </div>
                            @error('customerAddressUpdateForm.suburb')
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
                                    id="city"
                                    type="text"
                                    required
                                    wire:model.live="customerAddressUpdateForm.city"
                                    placeholder="Joburg"
                                >
                            </div>
                            @error('customerAddressUpdateForm.city')
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
                                    class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                                    id="province"
                                    wire:model.live="customerAddressUpdateForm.province"
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
                            @error('customerAddressUpdateForm.province')
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
                                    id="postal_code"
                                    type="text"
                                    required
                                    wire:model.live="customerAddressUpdateForm.postal_code"
                                    placeholder="1010"
                                >
                            </div>
                            @error('customerAddressUpdateForm.postal_code')
                            <div class="py-1">
                                <p class="text-xs text-pink-600">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        
                        
                        <div class="flex justify-end items-center px-6 pb-10">
                            <x-button class="button-green">
                                Save
                            </x-button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    
    
    {{--Company Docs--}}
    
    <div class="mb-3">
        <div
            class="bg-white rounded-b-lg shadow"
        >
            <button
                class="block p-2 w-full text-left text-white bg-black border-t shadow"
                wire:click="$set('activeTab','documents')"
            >
                <h3 class="text-lg">Company Documents</h3>
                <p class="text-xs text-gray-300">Upload your company documents</p>
            </button>
            
            @if($activeTab === 'documents')
                <div class="p-4">
                    <form wire:submit.prevent="updateCompanyDocuments">
                        
                        <div class="py-2">
                            <label
                                for="cipc_document"
                            >Company CK Document</label>
                            <div class="mt-1">
                                <input
                                    id="line_one"
                                    type="file"
                                    required
                                    wire:model.live="customerDocumentForm.cipc_documents"
                                >
                            </div>
                            @error('customerDocumentForm.cipc_documents')
                            <div class="py-1">
                                <p class="text-xs text-pink-600">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        
                        <div class="py-2">
                            <label
                                for="id_document"
                            >Company CK Document</label>
                            <div class="mt-1">
                                <input
                                    id="line_one"
                                    type="file"
                                    required
                                    wire:model.live="customerDocumentForm.id_document"
                                >
                            </div>
                            @error('customerDocumentForm.id_document')
                            <div class="py-1">
                                <p class="text-xs text-pink-600">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        
                        
                        <div class="flex justify-end items-center px-6 pb-10">
                            <x-button class="button-green">
                                Save
                            </x-button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    
    
    <div>
        <div class="flex justify-end items-center py-4 px-2 w-full border-t">
            <x-button
                class="button-green"
                wire:click="submit"
            >Submit Application
            </x-button>
        </div>
    </div>

</div>
