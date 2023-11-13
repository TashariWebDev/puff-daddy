<div>
    <div class="container p-6 py-24 mx-auto">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

            <div class="lg:col-span-2">
                <div class="mb-4">
                    <h1 class="text-lg font-bold">Shopping Cart</h1>
                    <p class="text-sm text-gray-500">Please confirm your purchase below.</p>
                </div>

                <div class="p-4 bg-white rounded-lg border">
                    @foreach($order->items as $item)
                        <div
                            class="justify-between pb-4 mb-4 lg:flex"
                            wire:key="{{$item->id . time()}}"
                        >
                            <div class="flex items-center space-x-2">
                                <div class="w-24">
                                    <img
                                        src="{{ $item->product->image }}"
                                        alt=""
                                        class="object-contain w-20 h-20 bg-gray-50 rounded-full"
                                    >
                                </div>
                                <div>
                                    <a
                                        href="{{ route('detail',$item->product->id) }}"
                                        wire:navigate
                                        class="font-bold hover:text-pink-600 hover:underline"
                                    >
                                        {{ $item->product->brand }} {{ $item->product->name }}
                                    </a>
                                    <div class="flex space-x-2">
                                        @foreach($item->product->features as $feature)
                                            <p class="text-xs">{{ $feature->name }}</p>
                                        @endforeach
                                    </div>
                                    <button
                                        wire:click="$dispatch('remove-item', { itemId: {{ $item->id }} })"
                                        class="text-pink-600 hover:text-pink-700 text-[12px]"
                                    >
                                        remove
                                    </button>
                                </div>
                            </div>

                            <div class="flex mt-4 space-x-4 lg:mt-0">
                                <div class="grid grid-cols-3">
                                    <div class="flex col-span-2 justify-center items-center">
                                        <input
                                            type="number"
                                            class="w-32 rounded-2xl shadow"
                                            value="{{ $item->qty }}"
                                            min="1"
                                            max="{{ $item->product->stocks->sum('qty') }}"
                                            wire:change.debounce="$dispatch('update-qty', { itemId: {{ $item->id }}, qty: $event.target.value })"
                                        >
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <p> / {{ $item->product->stocks->sum('qty') }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-end items-center w-48">
                                    <p>{{ $item->qty }} X {{ number_format($item->product->getPrice(),2) }}
                                        <span class="font-bold">R {{ number_format($item->product->getPrice() * $item->qty,2) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>


            <div>
                <div class="mb-4">
                    <h1 class="text-lg font-bold">Order total</h1>
                    <p class="text-sm text-gray-500">Shipping will be calculated at checkout</p>
                </div>
                <div class="flex-col p-4 space-y-6 bg-white rounded-lg border">
                    <div class="flex justify-between items-baseline">
                        <p class="font-semibold">Total</p>
                        <p>R {{ number_format($order->getTotal(),2) }}</p>
                    </div>

                    <div class="w-full">
                        <a
                            href="{{ route('checkout') }}"
                            class="block py-2 w-full rounded shadow button-green"
                        >Proceed to checkout</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4 bg-white rounded-lg border">

            <div class="py-4 px-8">
                <h2 class="font-bold">You may also like:</h2>
            </div>

            <div>
                <livewire:pages.welcome.featured-products />
            </div>
        </div>
    </div>


</div>
