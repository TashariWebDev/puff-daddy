<div class="py-20 px-6">
    <div class="container grid grid-cols-1 mx-auto lg:grid-cols-2">
        <div class="order-2 lg:order-1">

            {{-- Category & Brand Filter --}}
            <div class="flex items-center p-2 space-x-2">
                <a
                    href="{{ route('welcome',['brandQuery' => $this->product->brand ]) }}"
                    wire:navigate
                    class="text-teal-500 hover:text-teal-600 hover:underline"
                >{{ $this->product->brand }}</a>
                <p>/</p>
                <a
                    href="{{ route('welcome',['categoryQuery' => $this->product->category ]) }}"
                    wire:navigate
                    class="text-teal-500 hover:text-teal-600 hover:underline"
                >{{ $this->product->category }}</a>
            </div>


            {{--Title--}}
            <div class="p-2">
                <h1 class="text-3xl font-bold">{{ $this->product->brand }} {{ $this->product->name }}</h1>
                <div class="flex space-x-3">
                    @foreach($this->product->features as $feature)
                        <p>{{ $feature->name }}</p>
                    @endforeach
                </div>

                {{--Pricing--}}
                <div class="flex py-8 space-x-4">
                    @if($this->product->hasPriceDrop())
                        <p class="text-xl line-through">
                            R {{ number_format($this->product->getOldPrice(),2) }}</p>
                    @endif
                    <p class="text-xl font-bold">R {{ number_format($this->product->getPrice(),2) }}</p>
                </div>

                @if($this->product->product_collection?->products?->count())
                    <div class="py-8">
                        <div>
                            <label for="collection">Select an option</label>
                        </div>
                        <div
                            class="relative"
                            x-data="{show:false}"
                        >
                            <x-dropdown-button
                                x-on:click="show = !show"
                            >
                                <p class="whitespace-nowrap">{{ $this->product->name }}</p>
                                @foreach($this->product->features as $feature)
                                    <p class="whitespace-nowrap">{{ $feature->name }}</p>
                                @endforeach
                            </x-dropdown-button>

                            <div
                                class="overflow-x-hidden overflow-y-scroll absolute top-0 z-40 flex-col px-2 mt-20 w-full bg-white rounded shadow-xl max-h-[300px]"
                                x-show="show"
                                x-transition
                            >
                                @foreach($this->product->product_collection->products as $product)
                                    <button
                                        wire:click="updateProduct({{ $product->id }})"
                                        class="block py-2 px-2 w-full text-left bg-white border-b hover:bg-gray-100"
                                        tabindex="{{ $product->id }}"
                                        x-on:click="show = !show"
                                    >
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center space-x-1 font-semibold uppercase lg:space-x-3 lg:text-base text-[10px]">
                                                <p class="whitespace-nowrap">{{ $product->name }}</p>
                                                @foreach($product->features as $feature)
                                                    <p class="whitespace-nowrap">{{ $feature->name }}</p>
                                                @endforeach
                                                @if($product->stocks->sum('qty') <= 0)
                                                    <p class="text-xs text-pink-600">(sold out)</p>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- CTA - BUY NOW--}}
                <div>
                    <div class="mt-2.5">
                        @if ($this->product->stocks->sum('qty') > 0)
                            <div class="flex space-x-0.5">
                                <x-button
                                    class="flex justify-between items-center w-full lg:w-72 button-green"
                                    x-on:click="$dispatch('add-to-cart',{ product: {{$this->product->id}}, qty: 1 })"
                                >
                                    <p class="font-semibold whitespace-nowrap truncate">
                                        BUY NOW
                                    </p>
                                    <div>
                                        <x-icons.cart class="w-6 h-6 group-hover:animate-wiggle" />
                                    </div>
                                </x-button>

                                {{--                <x-button--}}
                                {{--                    class="flex relative justify-center items-center w-1/5 button-green"--}}
                                {{--                    wire:click="showAddToCart('{{ $this->product->id }}')"--}}
                                {{--                >--}}
                                {{--                  <x-icons.cart class="w-6 h-6 group-hover:animate-wiggle"/>--}}
                                {{--                  --}}
                                {{--                  <div class="absolute top-0 right-0">--}}
                                {{--                    <div class="flex space-x-0.5">--}}
                                {{--                      <x-icons.plus class="w-4 h-4"/>--}}
                                {{--                    </div>--}}
                                {{--                  </div>--}}
                                {{--                </x-button>--}}
                            </div>
                        @endif


                        <div>
                            @if ($this->product->stocks->sum('qty') <= 0)
                                <div x-data="{ show:false }">

                                    <x-button
                                        class="flex justify-between items-center w-full lg:w-72 button-pink-alt"
                                        wire:click="showStockAlert('{{ $this->product->id }}')"
                                    >
                                        <p class="font-semibold whitespace-nowrap truncate">
                                            SOLD OUT
                                        </p>
                                        <div>
                                            <x-icons.bell class="w-6 h-6 group-hover:animate-wiggle" />
                                        </div>
                                    </x-button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="py-8 max-w-prose prose">
                    <p>
                        {!! nl2br($this->product->description) !!}
                    </p>
                </div>

                @if($this->brand->page)
                    <div class="mt-4">
                        <a href="{{ route('preview',$this->brand->page->id) }}"
                           class="text-teal-500 border-teal-500 hover:border-b"
                        >&rarr; Learn more about {{$this->product->brand}}</a>
                    </div>
                @else
                    <div class="py-2">
                        <a href="#"
                           class="invisible"
                        >Learn More</a>
                    </div>
                @endif

            </div>
        </div>
        <div>
            <div
                class="p-2"
            >
                <img
                    src="{{ $this->product->image }}"
                    alt=""
                    class="object-fill object-center w-full bg-contain rounded-lg shadow aspect-square"
                >
            </div>
        </div>
    </div>

    {{--  Add to Cart Modal --}}
    @if($selectedProduct)
        <x-modal
            title="Add to cart"
            name="add-to-cart-modal"
        >

            <div>
                <div class="py-4">
                    <h2
                        class="text-sm font-semibold text-gray-600"

                    >Qty required:
                        <span>{{ $qty }} / {{$selectedProduct->stocks->sum('qty')}}</span>
                    </h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div>
                        <div lass="pb-1">
                            <label
                                for="qty"
                                class="text-gray-500 text-[12px]"
                            >Qty Required</label>
                        </div>
                        <input
                            class="w-32 rounded"
                            type="number"
                            wire:model.live="qty"
                            id="qty"
                            min="1"
                            max="{{ $selectedProduct->stocks->sum('qty') }}"
                        >
                    </div>

                    @if($selectedProduct->stocks->sum('qty') >= 5)
                        <div>
                            <div lass="pb-1">
                                <label
                                    for="qty"
                                    class="text-gray-500 text-[12px]"
                                >Add 5 Units</label>
                            </div>
                            <x-button
                                class="py-2 w-32 text-center button-green"
                                wire:click="$set('qty',5)"
                            >
                                + 5
                            </x-button>
                        </div>
                    @endif

                    @if($selectedProduct->stocks->sum('qty') >= 10)
                        <div>
                            <div lass="pb-1">
                                <label
                                    for="qty"
                                    class="text-gray-500 text-[12px]"
                                >Add 10 Units</label>
                            </div>
                            <x-button
                                class="py-2 w-32 text-center button-green"
                                wire:click.prevent="$set('qty',10)"
                            >
                                + 10
                            </x-button>
                        </div>
                    @endif

                    @if($selectedProduct->stocks->sum('qty') > 5)
                        <div>
                            <div class="pb-1">
                                <label
                                    for="qty"
                                    class="text-gray-500 text-[12px]"
                                >Add All</label>
                            </div>
                            <x-button
                                class="py-2 w-32 text-center button-green"
                                wire:click="$set('qty',{{ $selectedProduct->stocks->sum('qty') }})"
                            >
                                + {{ $selectedProduct->stocks->sum('qty') }}
                            </x-button>
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <x-button
                        class="py-2 px-4 text-center button-green w-fit"
                        x-on:click="$dispatch('add-to-cart',{ product: {{$selectedProduct}}, qty: {{$qty}} })"
                    >
                        ADD TO CART
                    </x-button>
                </div>
            </div>
        </x-modal>
    @endif

    {{--  Stock Alert Modal --}}
    @if($selectedProduct)
        <x-modal
            title="Set stock alert"
            name="stock-alerts"
        >

            <div class="my-6">
                <p class="font-bold text-gray-600">
                    We will email you as soon as {{ $selectedProduct->brand }} {{ $selectedProduct->name }}
                    is re-stocked
                </p>
            </div>

            <form wire:submit="saveStockAlert">
                <div class="mt-4">
                    <label
                        for="email"
                        :value="__('Email')"
                    >
                        Enter your email
                    </label>
                    <input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        wire:model="email"
                        required
                        autofocus
                    />
                </div>
                <div class="mt-4">
                    <x-button class="flex justify-between items-center w-full button-green">

                        <p class="font-semibold text-green-100 whitespace-nowrap group-hover:text-green-800 text-[12px] truncate">
                            NOTIFY ME
                        </p>

                        <x-icons.bell class="w-6 h-6 text-green-100 group-hover:text-green-800 group-hover:animate-wiggle" />
                    </x-button>
                </div>
            </form>
        </x-modal>
    @endif
</div>
