<div>
    @if($this->latestProductsPurchased->count())
        <div class="overflow-hidden py-6 px-1 mx-auto bg-white sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 gap-x-2 gap-y-4 -mx-px sm:mx-0 md:grid-cols-4 lg:grid-cols-6 lg:gap-4 lg:gap-y-6">
                @foreach($this->latestProductsPurchased as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>

            @if($selectedProduct)
                <x-modal
                    title="Set stock alert"
                    name="stock-alerts"
                >

                    <div class="my-6">
                        <p class="font-bold text-gray-600">
                            We will email you as soon as {{ $selectedProduct->brand }} {{ $selectedProduct->name }} is
                            re-stocked
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

                                <p class="font-semibold whitespace-nowrap truncate">
                                    NOTIFY ME
                                </p>
                                <x-icons.bell class="w-6 h-6 group-hover:animate-wiggle" />
                            </x-button>
                        </div>
                    </form>
                </x-modal>
            @endif

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
                                <span>{{ $qty }} / {{$selectedProductQtyAvailable}}</span>
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
                                    max="{{ $selectedProductQtyAvailable }}"
                                >
                            </div>

                            @if($selectedProduct->stocks_sum_qty >= 5)
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

                            @if($selectedProductQtyAvailable >= 10)
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

                            <div>
                                <div class="pb-1">
                                    <label
                                        for="qty"
                                        class="text-gray-500 text-[12px]"
                                    >Add All</label>
                                </div>
                                <x-button
                                    class="py-2 w-32 text-center button-green"
                                    wire:click="$set('qty',{{ $selectedProductQtyAvailable }})"
                                >
                                    + {{ $selectedProductQtyAvailable }}
                                </x-button>
                            </div>
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
        </div>
    @endif

</div>
