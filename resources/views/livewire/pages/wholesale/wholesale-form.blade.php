<div>

{{-- Business Info --}}
  <div class="mb-3">
    <div
        class="bg-white rounded-b-lg shadow"
    >
       <button
           class="block p-2 w-full text-left text-white rounded-lg border-t shadow bg-slate-900"
           wire:click="$set('activeTab','business')"
       >
          <h3 class="text-lg font-medium leading-6">Business & contact Information</h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-300">
            Kindly supply us with your business and contact info.
          </p>
      </button>
      @if($activeTab === 'business')
        <div>
        <form wire:submit="updateCustomer">
              <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                
                <dt class="text-sm font-medium text-gray-500">Full name</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="name"
                    ></label>
                    <input
                        id="name"
                        type="text"
                        required
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.name"
                        placeholder="John Doe"
                    >
                    @error('customerUpdateForm.name')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
                
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="email"
                    ></label>
                    <input
                        id="email"
                        type="email"
                        required
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.email"
                        placeholder="vape@nosmoking.com"
                    >
                    @error('customerUpdateForm.email')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
                <dt class="text-sm font-medium text-gray-500">Mobile phone</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="phone"
                    ></label>
                    <input
                        id="phone"
                        type="text"
                        required
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.phone"
                        placeholder="081 911 9111"
                    >
                    @error('customerUpdateForm.phone')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
                <dt class="text-sm font-medium text-gray-500">Alt phone (landline)</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="alt_phone"
                    ></label>
                    <input
                        id="alt_phone"
                        type="text"
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.alt_phone"
                        placeholder="0119119111"
                    >
                    @error('customerUpdateForm.alt_phone')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
                <dt class="text-sm font-medium text-gray-500">Company registered name</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="registered_company_name"
                    ></label>
                    <input
                        id="registered_company_name"
                        type="text"
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.registered_company_name"
                        placeholder="Joe's Vapes PTY Ltd"
                    >
                    @error('customerUpdateForm.registered_company_name')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
                <dt class="text-sm font-medium text-gray-500">Company trading name</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="company"
                    ></label>
                    <input
                        id="company"
                        type="text"
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.company"
                        placeholder="Joe's Vapes"
                    >
                    @error('customerUpdateForm.company')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
                <dt class="text-sm font-medium text-gray-500">Company VAT Number (optional)</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <div>
                    <label
                        class="hidden"
                        for="vat_number"
                    ></label>
                    <input
                        id="vat_number"
                        type="text"
                        class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                        wire:model.live="customerUpdateForm.vat_number"
                        placeholder="123456789"
                    >
                    @error('customerUpdateForm.vat_number')
                    <p class="text-xs text-pink-600">{{ $message }}</p>
                    @enderror
                  </div>
                </dd>
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
           class="block p-2 w-full text-left text-white rounded-lg border-t shadow bg-slate-900"
           wire:click="$set('activeTab','address')"
       >
            <h3 class="text-lg">Delivery Addresses</h3>
            <p class="text-xs text-gray-300">Add all your delivery addresses</p>
      </button>
      
      @if($activeTab === 'address')
        <div>
          <form wire:submit.prevent="saveAddress">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
              
              <dt class="text-sm font-medium text-gray-500">Street Address</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <div>
                  <label
                      class="hidden"
                      for="line_one"
                  ></label>
                  <input
                      id="line_one"
                      type="text"
                      required
                      class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                      wire:model.live="line_one"
                      placeholder="10 John Doe Street"
                  >
                  @error('line_one')
                  <p class="text-xs text-pink-600">{{ $message }}</p>
                  @enderror
                </div>
              </dd>
              
              <dt class="text-sm font-medium text-gray-500">Building / Complex / Unit number</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <div>
                  <label
                      class="hidden"
                      for="line_two"
                  ></label>
                  <input
                      id="line_two"
                      type="text"
                      class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                      wire:model.live="line_two"
                      placeholder="10 The Apartments"
                  >
                  @error('line_two')
                  <p class="text-xs text-pink-600">{{ $message }}</p>
                  @enderror
                </div>
              </dd>
              
              <dt class="text-sm font-medium text-gray-500">Suburb</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <div>
                  <label
                      class="hidden"
                      for="suburb"
                  ></label>
                  <input
                      id="suburb"
                      type="text"
                      class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                      wire:model.live="suburb"
                      placeholder="SomeVille"
                  >
                  @error('suburb')
                  <p class="text-xs text-pink-600">{{ $message }}</p>
                  @enderror
                </div>
              </dd>
              
              <dt class="text-sm font-medium text-gray-500">City</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <div>
                  <label
                      class="hidden"
                      for="city"
                  ></label>
                  <input
                      id="city"
                      type="text"
                      class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                      wire:model.live="city"
                      placeholder="Sandton"
                  >
                  @error('city')
                  <p class="text-xs text-pink-600">{{ $message }}</p>
                  @enderror
                </div>
              </dd>
              
              <dt class="text-sm font-medium text-gray-500">Province</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <div>
                  <label
                      class="hidden"
                      for="province"
                  ></label>
                  <select
                      class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                      id="province"
                      wire:model.live="province"
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
                  
                  @error('province')
                  <p class="text-xs text-pink-600">{{ $message }}</p>
                  @enderror
                </div>
              </dd>
              
              <dt class="text-sm font-medium text-gray-500">Postal code</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <div>
                  <label
                      class="hidden"
                      for="postal_code"
                  ></label>
                  <input
                      id="postal_code"
                      type="text"
                      class="rounded border-gray-400 focus:border-amber-300 focus:ring-0 focus:outline-none outline-amber-300"
                      wire:model.live="postal_code"
                      placeholder="1111"
                  >
                  @error('postal_code')
                  <p class="text-xs text-pink-600">{{ $message }}</p>
                  @enderror
                </div>
              </dd>
            
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
  
  
  {{-- Documents --}}
  
  <div class="mb-3">
    <div
        class="bg-white rounded-b-lg shadow"
    >
       <button
           class="block p-2 w-full text-left text-white rounded-lg border-t shadow bg-slate-900"
           wire:click="$set('activeTab','documents')"
       >
            <h3 class="text-lg">Documents</h3>
            <p class="text-xs text-gray-300">Upload your company and director documents</p>
      </button>
      
      @if($activeTab === 'documents')
        <div>
         <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Documents</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
              <ul
                  class="rounded-md border border-gray-200 divide-y divide-gray-200"
                  role="list"
              >
                <li>
                  <div class="p-2">
                    <label
                        class="text-xs text-slate-400"
                        for="id_document"
                    >Upload director ID Document</label>
                    <div class="py-2">
                      <input
                          id="id_document"
                          type="file"
                          wire:model.live="id_document"
                      >
                    </div>
                  </div>
                  @if (auth()->user()->id_document)
                    <div class="flex justify-between items-center py-3 pr-4 pl-3 text-sm">
                      <div class="flex flex-1 items-center w-0">
                        <!-- Heroicon name: mini/paper-clip -->
                        <svg
                            class="flex-shrink-0 w-5 h-5 text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                          <path
                              fill-rule="evenodd"
                              d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                              clip-rule="evenodd"
                          />
                        </svg>
                        <span class="flex-1 ml-2 w-0 truncate">Director ID Document</span>
                      </div>
                      <div class="flex-shrink-0 items-center ml-4 space-x-6">
                        <a
                            class="font-medium text-pink-600 hover:text-pink-500"
                            href="#"
                            wire:click.prevent="removeIdDocument"
                            download
                        >Remove</a>
                        <a
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                            href="{{ asset('storage/' . auth()->user()->id_document) }}"
                            download
                        >Download</a>
                      </div>
                    </div>
                  @endif
                
                </li>
                <li>
                  <div class="p-2">
                    <label
                        class="text-xs text-slate-400"
                        for="id_document"
                    >Upload CIPC company Documents</label>
                    <div class="py-2">
                      <input
                          id="cipc_documents"
                          type="file"
                          wire:model.live="cipc_documents"
                      >
                    </div>
                  </div>
                  @if (auth()->user()->cipc_documents)
                    <div class="flex justify-between items-center py-3 pr-4 pl-3 text-sm">
                      <div class="flex flex-1 items-center w-0">
                        <!-- Heroicon name: mini/paper-clip -->
                        <svg
                            class="flex-shrink-0 w-5 h-5 text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                          <path
                              fill-rule="evenodd"
                              d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                              clip-rule="evenodd"
                          />
                        </svg>
                        <span class="flex-1 ml-2 w-0 truncate">CIPC Documents</span>
                      </div>
                      <div class="flex-shrink-0 items-center ml-4 space-x-6">
                        <a
                            class="font-medium text-pink-600 hover:text-pink-500"
                            href="#"
                            wire:click.prevent="removeCipc"
                            download
                        >Remove</a>
                        <a
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                            href="{{ asset('storage/' . auth()->user()->cipc_documents) }}"
                            download
                        >Download</a>
                      </div>
                    </div>
                  @endif
                
                </li>
              </ul>
            </dd>
          </div>
      </div>
      @endif
    </div>
  </div>
  
  {{--  Photos --}}
  
  <div class="mb-3">
    <div
        class="bg-white rounded-b-lg shadow"
    >
       <button
           class="block p-2 w-full text-left text-white rounded-lg border-t shadow bg-slate-900"
           wire:click="$set('activeTab','photos')"
       >
            <h3 class="text-lg">Photos</h3>
            <p class="text-xs text-gray-300">
              Upload photos of the interior and exterior of your business.
            </p>
      </button>
      
      
      @if($activeTab === 'photos')
        <div
            class="p-2"
        >
          <div>
          <label for="photos">
            Drop multiple photos or click here to upload (.png or .jpeg - less than 1MB each)
          </label>
          <input
              class="py-4 px-6 mt-2 w-full h-full bg-gray-100 rounded sm:col-span-2 sm:mt-0"
              type="file"
              multiple
              wire:model.live="photos"
          >
            @error('photos')
            <p class="text-xs text-pink-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="container grid grid-cols-2 gap-6 p-6 w-full bg-white rounded-lg lg:grid-cols-3 dark:bg-slate-800">
        @foreach (auth()->user()->businessImages as $image)
            <div class="w-full bg-white rounded-lg shadow">
            <img
                class="object-cover"
                src="{{ asset('storage/' . $image->photo) }}"
                alt="image"
            >
          </div>
          @endforeach
      </div>
      </div>
      @endif
    </div>
  </div>
  
    <div>
        <div class="flex justify-end items-center py-4 w-full border-t">
            <x-button
                class="w-1/5 button-green"
                wire:click="submit"
            >Submit Application
            </x-button>
          </div>
    </div>

</div>
