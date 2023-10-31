<div>
  <div>
    <div class="overflow-hidden bg-white">
      
      <div class="p-2 text-white rounded-lg border-t bg-slate-900">
        <h3 class="text-lg font-medium leading-6">Business & contact Information</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-300">
          Kindly supply us with your business and contact info.
        </p>
      </div>
      
      <div class="py-5 px-4 border-t border-gray-200 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
          <form wire:submit="save">
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
                      wire:model.live="customer.name"
                      placeholder="John Doe"
                  >
                  @error('customer.name')
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
                      wire:model.live="customer.email"
                      placeholder="vape@nosmoking.com"
                  >
                  @error('customer.email')
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
                      wire:model.live="customer.phone"
                      placeholder="081 911 9111"
                  >
                  @error('customer.phone')
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
                      wire:model.live="customer.alt_phone"
                      placeholder="0119119111"
                  >
                  @error('customer.alt_phone')
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
                      wire:model.live="customer.registered_company_name"
                      placeholder="Joe's Vapes PTY Ltd"
                  >
                  @error('customer.registered_company_name')
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
                      wire:model.live="customer.company"
                      placeholder="Joe's Vapes"
                  >
                  @error('customer.company')
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
                      wire:model.live="customer.vat_number"
                      placeholder="123456789"
                  >
                  @error('customer.vat_number')
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
          
          <div class="p-2 text-white rounded-lg border-t bg-slate-900">
            <h3 class="text-lg">Delivery Addresses</h3>
            <p class="text-xs text-gray-300">Add all your delivery addresses</p>
          </div>
          
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
                      class="w-full rounded border-gray-300"
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
          
          <div class="py-5 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-slate-50">
            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Addresses</dt>
            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-slate-900 dark:text-slate-300">
              @foreach ($customer->addresses as $address)
                <div class="py-2">
                  <p>
                    {{ ucwords($address->line_one) }} {{ ucwords($address->line_two) }}
                    {{ ucwords($address->suburb) }}
                    {{ ucwords($address->city) }} {{ ucwords($address->province) }}
                    {{ $address->postal_code }}
                  </p>
                </div>
              @endforeach
            </dd>
          </div>
          
          <div class="p-2 text-white rounded-lg border-t bg-slate-900">
            <h3 class="text-lg">Documents</h3>
            <p class="text-xs text-gray-300">Upload your company and director documents</p>
          </div>
          
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
                  @if ($customer->id_document)
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
                            href="{{ asset('storage/' . $customer->id_document) }}"
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
                  @if ($customer->cipc_documents)
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
                            href="{{ asset('storage/' . $customer->cipc_documents) }}"
                            download
                        >Download</a>
                      </div>
                    </div>
                  @endif
                
                </li>
              </ul>
            </dd>
          </div>
        </dl>
      </div>
      
      <div class="p-2 text-white rounded-lg border-t bg-slate-900">
        <h3 class="text-lg">Photos</h3>
        <p class="text-xs text-gray-300">
          Upload photos of the interior and exterior of your business.
        </p>
      </div>
      
      <div class="py-4 px-6 mt-2 bg-gray-100 rounded border-t">
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
      </div>
      
      <div class="container grid grid-cols-2 gap-6 p-6 w-full bg-white rounded-lg lg:grid-cols-3 dark:bg-slate-800">
        @foreach ($customer->businessImages as $image)
          <div class="w-full bg-white rounded-lg shadow">
            <img
                class="object-cover"
                src="{{ asset('storage/' . $image->photo) }}"
                alt="image"
            >
          </div>
        @endforeach
      </div>
      
      @if ($customer->businessImages->count() && $customer->id_document && $customer->cipc_documents)
        <div class="flex justify-end items-center py-4 w-full border-t">
          <x-button
              class="w-1/5 button-green"
              wire:click="submit"
          >Submit Application
          </x-button>
        </div>
      @endif
    </div>
  
  </div>

</div>
