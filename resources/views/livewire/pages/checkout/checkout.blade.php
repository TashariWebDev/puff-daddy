<div class="container p-6 py-24 mx-auto">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

        <div>
            <div class="p-4 mb-4 bg-white rounded-lg border">
                <div class="mb-4">
                    <h1 class="text-lg font-bold">Contact Details</h1>
                    <p class="text-sm text-gray-500">Please confirm contact details below.</p>
                </div>

                <div>
                    <form wire:submit.prevent="updateUser">

                        <div class="py-2">
                            <label for="email-address">Email address</label>
                            <div class="pt-1">
                                <input
                                    type="email"
                                    id="email-address"
                                    class="w-full"
                                    wire:model.defer="email"
                                    wire:change.debounce.1500ms="updateUser"
                                />
                            </div>
                            @error('email')
                            <div class="py-1">
                                <p class="text-xs text-red-600 uppercase">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label for="name">Full Name</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="name"
                                    class="w-full"
                                    wire:model.defer="name"
                                    wire:change.debounce.1500ms="updateUser"
                                />
                            </div>
                            @error('name')
                            <div class="py-1">
                                <p class="text-xs text-red-600 uppercase">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label for="phone">Phone</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="phone"
                                    class="w-full"
                                    wire:model.defer="phone"
                                    wire:change.debounce.1500ms="updateUser"
                                />
                            </div>
                            @error('phone')
                            <div class="py-1">
                                <p class="text-xs text-red-600 uppercase">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label for="company">Business / Company Name (if delivery at work)</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="company"
                                    class="w-full"
                                    wire:model.defer="company"
                                    wire:change.debounce.1500ms="updateUser"
                                />
                            </div>
                            @error('company')
                            <div class="py-1">
                                <p class="text-xs text-red-600 uppercase">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label for="vat_number">Vat number</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="vat_number"
                                    class="w-full"
                                    placeholder="optional"
                                    wire:model.defer="vat_number"
                                    wire:change.debounce.1500ms="updateUser"
                                />
                            </div>
                            @error('vat_number')
                            <div class="py-1">
                                <p class="text-xs text-red-600 uppercase">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg border">
                <div class="mb-4">
                    <h1 class="text-lg font-bold">Delivery Address</h1>
                    <p class="text-sm text-gray-500">Please confirm your delivery address below.</p>
                </div>

                <div>
                    <form wire:submit.prevent="updateAddress">
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
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border lg:rounded-lg">

            <div class="py-2">
                <p class="font-extrabold text-slate-900">Order Summary</p>
            </div>


            <dl class="py-6 space-y-6">


                <div class="flex justify-between items-center pb-3 border-b">
                    <dt class="text-sm font-semibold">Subtotal</dt>
                    <dd class="text-sm font-medium text-slate-900">
                        R {{ number_format($this->order->getSubTotal(),2) }}</dd>
                </div>

                @if(!$this->address)
                    <div class="p-3 w-full text-pink-800 bg-pink-100 rounded ring-1 ring-pink-800">
                        <p>Please update your address to continue</p>
                    </div>
                @endif

                @if($this->address)

                    <div class="pt-6 pb-2">
                        <p class="font-extrabold text-slate-900">Shipping options</p>
                    </div>

                    @foreach($deliveryOptions as $deliveryOption)

                        <div class="flex justify-between items-baseline">
                            <dt class="capitalize">
                                <label
                                    for="{{ $deliveryOption->id }}"
                                >
                                    <input
                                        type="radio"
                                        wire:change="updateSelectedDelivery({{$deliveryOption->id}})"
                                        id="{{ $deliveryOption->id }}"
                                        @checked($deliveryOption->id === $this->order->delivery_type_id)
                                    >
                                    <span class="ml-2 text-xs lg:text-sm">
                                    {{ $deliveryOption->description }}
                                    </span>
                                </label>
                            </dt>
                            <dd class="text-xs font-medium whitespace-nowrap lg:text-sm text-slate-900">
                                R {{ number_format($deliveryOption->getPrice($this->order->getSubTotal()),2) }}
                            </dd>
                        </div>
                    @endforeach


                    <div class="flex justify-between items-center py-6 border-y border-slate-200">
                        <dt class="text-base font-medium">Due today :</dt>
                        <dd class="text-base font-semibold text-slate-900">
                            <p>
                                R {{ number_format($this->order->getTotal(),2) }}
                            </p>
                        </dd>
                    </div>


                    <div class="w-full">
                        <label for="note">Delivery instructions</label>
                        <div class="pt-1">
                            <label for="note"></label>
                            <textarea
                                id="note"
                                class="w-full h-32 text-sm rounded-md border-none focus:ring-1 bg-slate-100 text-slate-800 placeholder-slate-400 focus:ring-sky-400"
                                placeholder="Please advise on any special delivery instructions or requirements"
                                wire:model.debounce.1500ms="body"
                                wire:change.debounce="updateNote"
                            ></textarea>
                        </div>
                        @error('body')
                        <div class="pt-1">
                            <p class="text-red-600 uppercase text-[10px]">{{ $message }}</p>
                        </div>
                        @enderror
                    </div>

                @endif
            </dl>

            @if(!$this->address)
                <div></div>
            @else
                <div class="pt-6 pb-2">

                    <div class="pb-6">
                        <p class="font-extrabold text-slate-900">How would you like to pay?</p>
                    </div>

                    @if( auth()->user()->isWholesale())
                        <div class="items-baseline py-6 border-b lg:flex lg:justify-between">
                            <div>
                                <p class="font-semibold whitespace-nowrap text-slate-800">
                                    Place manual order
                                </p>
                            </div>
                            <div class="flex justify-between items-baseline w-32 lg:justify-start">
                                <button
                                    wire:click="placeOrder"

                                    class="block py-3 mt-3 w-full h-full bg-gray-600 rounded-lg shadow lg:mt-0 button-green"
                                >
                                    Place EFT order
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="py-6 border-b lg:flex lg:justify-between lg:items-start">
                        <div>
                            <p class="font-semibold whitespace-nowrap text-slate-800">
                                Pay with Yoco
                            </p>
                        </div>
                        <div class="flex justify-between items-baseline w-32 lg:justify-start">
                            <button
                                wire:click="attemptPaymentWithYoco"
                                class="block mt-3 w-full h-full bg-white rounded-lg border shadow lg:mt-0 hover:bg-gray-50 border-sky-400"
                            >
                                <img
                                    src="{{ asset('design/yoco.svg') }}"
                                    alt=""
                                    class="object-cover p-1 mx-auto w-full h-full rounded-lg"
                                    wire:target="attemptPaymentWithYoco"
                                >

                            </button>
                        </div>
                    </div>

                    <div class="py-6 border-b lg:flex lg:justify-between lg:items-start dark:border-slate-800">
                        <div>
                            <p class="font-semibold whitespace-nowrap text-slate-800">
                                Pay with Ozow Instant EFT
                            </p>
                        </div>

                        <div class="flex justify-between items-baseline w-32 lg:justify-start">
                            <button id="yoco-checkout-button"
                                    disabled
                                    class="block mt-3 w-full h-full bg-gray-900 rounded-lg shadow lg:mt-0 disabled:opacity-70 disabled:cursor-not-allowed"
                                {{--                                    x-on:click="$refs.ozow.submit()"--}}
                            >
                                <img src="{{ asset('design/Ozow-Logo-Colour_OnBlack.png') }}"
                                     alt=""
                                     class="object-cover p-1 mx-auto w-full h-full rounded-lg"
                                >
                            </button>
                        </div>

                        {{--                        <div class="hidden">--}}
                        {{--                            <form action="{{ config('services.ozow.liveUrl')}}"--}}
                        {{--                                  method="POST"--}}
                        {{--                                  class="hidden"--}}
                        {{--                                  x-ref="ozow"--}}
                        {{--                            >--}}
                        {{--                                @csrf--}}
                        {{--                                @foreach ($ozowPostData as $key => $value)--}}
                        {{--                                    <input type="hidden"--}}
                        {{--                                           name="{{$key}}"--}}
                        {{--                                           value="{{$value}}"--}}
                        {{--                                    >--}}
                        {{--                                @endforeach--}}
                        {{--                            </form>--}}
                        {{--                        </div>--}}
                    </div>


                    <div class="items-baseline py-2 mt-12 lg:flex lg:justify-between">
                        <div>
                            <p class="font-semibold whitespace-nowrap text-slate-800">
                                Forget something?
                            </p>
                        </div>
                        <a
                            href="{{ route('welcome') }}"
                            class="mt-3 lg:mt-0 button-success"
                        >
                            &larr; Continue Shopping
                        </a>
                    </div>

                </div>
            @endif
        </div>

    </div>
</div>
