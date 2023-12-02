<div class="bg-white rounded-lg border border-transparent shadow hover:ring hover:ring-teal-400">
    <div
        class=""
        wire:key="{{ $product->id }}"
    >


        <a
            href="{{ route('detail',$product->id) }}"
            wire:navigate
            class="block overflow-hidden relative bg-white rounded-lg aspect-w-1 aspect-h-1"
        >
            <div>

                @if($product->is_sale)
                    <div class="absolute inset-0 left-0 mx-auto mt-3">
                        <div class="py-1 px-2 rounded">
                            <p class="font-bold text-teal-600 text-[10px]">SALE</p>
                        </div>
                    </div>
                @endif

                <img
                    src="{{ $product->image }}"
                    alt=""
                    class="object-fill object-center z-30 w-full bg-contain rounded-lg aspect-square"
                >

                @if($product->hasPriceDrop())
                    <div class="absolute top-0 right-0 p-1 mt-4 mr-2 bg-black rounded ring-2 ring-white shadow">
                        <div class="leading-none text-center">
                            <div class="pb-0.5">
                                <p class="font-semibold text-teal-300 text-[10px]">SAVE</p>
                            </div>
                            @if(percentage_saved($product->getPrice(),$product->getOldPrice()) < 25)
                                <p class="font-semibold text-white text-[10px]">{{ percentage_saved($product->getPrice(),$product->getOldPrice()) }}</p>
                            @else
                                <p class="font-semibold text-white whitespace-nowrap text-[10px]">
                                    R {{ number_format($product->getOldPrice() - $product->getPrice()) }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </a>


        <div
            class="px-2 mt-6 w-full bg-white"
            title="{{ $product->brand }} {{ $product->name }}"
        >
            <a
                href="{{ route('detail',$product->id) }}"
                wire:navigate
            >
                <p class="text-xs font-bold whitespace-nowrap truncate">
                    {{ $product->brand }} {{ $product->name }}
                </p>

                <div class="flex overflow-hidden flex-wrap py-1 leading-3 h-[32px]">
                    @foreach($product->features as $feature)
                        <p class="pr-1 whitespace-nowrap text-[10px]">{{ $feature->name }}</p>
                    @endforeach
                </div>
            </a>

            <a
                href="{{ route('detail',$product->id) }}"
                wire:navigate
                class="flex-col leading-2"
            >
                <p class="text-base font-bold text-gray-700 whitespace-nowrap truncate">
                    @if ($product->hasPriceDrop())
                        <span class="pr-3 line-through"> R {{ number_format($product->getOldPrice(),2) }}</span>
                    @endif
                    R {{ number_format($product->getPrice(), 2) }}
                </p>

                @if ($product->stocks_sum_qty > 0)
                    <p class="text-gray-500 leading-1 text-[10px]">
                        {{$product->stocks_sum_qty}} Available
                    </p>
                @endif

                @if ($product->stocks_sum_qty <= 0)
                    <p class="text-gray-500 text-[10px]">
                        Sold Out
                    </p>
                @endif
            </a>

        </div>
    </div>

    <div class="rounded-b-lg">
        <div>
            @if ($product->stocks_sum_qty > 0)
                <div class="flex space-x-0.5">
                    <x-button
                        class="flex justify-between items-center w-full rounded-t-none rounded-b-lg button-green"
                        x-on:click="$dispatch('add-to-cart',{ product: {{$product->id}}, qty: 1 })"
                    >
                        <p class="font-semibold whitespace-nowrap truncate">
                            Buy Now
                        </p>
                        <div class="hidden lg:block">
                            <x-icons.cart class="w-6 h-6 text-green-100 group-hover:text-teal-100 group-hover:animate-wiggle" />
                        </div>
                    </x-button>
                </div>
            @endif


            <div>
                @if ($product->stocks_sum_qty <= 0)
                    <div x-data="{ show:false }">
                        <x-button
                            class="flex justify-between items-center w-full rounded-t-none rounded-b-lg button-pink-alt"
                            wire:click="showStockAlert('{{ $product->id }}')"
                        >
                            <p class="font-semibold whitespace-nowrap truncate">
                                Set Alert
                            </p>
                            <div>
                                <x-icons.bell class="w-6 h-6 text-pink-600 group-hover:text-pink-900 group-hover:animate-wiggle" />
                            </div>
                        </x-button>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
