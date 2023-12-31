<div class="z-30 bg-gray-50">

    {{-- search and filters --}}
    <div>
        <div class="flex z-30 justify-center items-center py-6 px-1 bg-black lg:px-8">

            <div class="flex px-2 mt-1 w-full rounded-md shadow-sm md:w-full">
                <div class="flex relative flex-grow items-stretch w-full focus-within:z-10">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <x-icons.search class="w-5 h-5" />
                    </div>
                    <label
                        class="hidden"
                        for="search"
                    ></label>
                    <input
                        id="search"
                        type="search"
                        autocomplete="off"
                        wire:model.live="searchQuery"
                        @class([
                            'focus:ring-yellow-500 focus:border-yellow-500 block w-full rounded-l-md pl-10 sm:text-sm border-gray-300 rounded-r-none text-lg',
                            'border-yellow-500' => $searchQuery,
                        ])
                        placeholder="search by brand, flavour or category"
                    >
                </div>

                <button
                    class="inline-flex relative items-center py-2 px-4 -ml-px space-x-2 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-300 hover:bg-gray-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none"
                    type="button"
                    aria-label="Clear search query"
                    wire:click="resetFilters"
                    title="Reset Search and filters"
                >
                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>

            </div>

        </div>
        {{--Category Filter--}}
        <div class="flex overflow-x-scroll items-center px-2 pb-3 space-x-6 w-full bg-black lg:px-8 no-scrollbar">
            <button class="px-3 font-semibold text-white bg-gradient-to-b from-teal-400 to-teal-600 rounded hover:bg-teal-600 hover:from-teal-500 hover:to-teal-600 focus:rounded-sm y-2 focus:outline focus:outline-2 focus:outline-teal-500"
                    wire:click="resetFilters"
            >
                Clear Filters
            </button>
            <button class="px-3 font-semibold text-white rounded hover:bg-teal-600 hover:from-teal-500 hover:to-teal-600 focus:rounded-sm y-2 focus:outline focus:outline-2 focus:outline-teal-500 @if($categoryQuery === '') bg-gradient-to-b from-teal-400 to-teal-600 @endif"
                    wire:click="$set('categoryQuery', '')"
            >
                Show All
            </button>
            @foreach($categories as $category)
                <button class="px-3 font-semibold text-white border border-teal-400  rounded hover:bg-teal-600 hover:from-teal-500 hover:to-teal-600 focus:rounded-sm y-2 focus:outline focus:outline-2 focus:outline-teal-500 @if($categoryQuery === $category) bg-gradient-to-b from-teal-400 to-teal-600 @endif"
                        wire:click="$set('categoryQuery', '{{ $category }}')"
                >
                    {{ $category }}
                </button>
            @endforeach
        </div>
    </div>


    {{--brands filter--}}

    <div class="overflow-hidden py-6 mx-auto bg-gray-50 sm:px-6 lg:px-8 no-scrollbar">
        <div
            class="flex overflow-x-auto overflow-y-hidden items-center px-2 pb-8 ml-0 w-full rounded-lg snap-x snap-mandatory no-scrollbar"
        >
            <div class="flex items-center space-x-4 lg:space-x-6 animate-ticker">
                @for($i = 0; $i < 20; $i++)
                    @foreach($brands as $brand)
                        <div class="flex-col py-1 rounded-lg">
                            <button
                                class="relative rounded-lg shadow hover:ring hover:ring-teal-400 hover:opacity-95 w-[240px] snap-proximity group lg:w-[360px] lg:snap-center"
                                wire:click="$set('brandQuery','{{ $brand->name }}')"
                            >
                                <div class="rounded-t-lg">
                                    <img src="{{$brand->image}}"
                                         alt="{{ $brand->name }}"
                                         class="rounded-t-lg"
                                    >
                                </div>
                                <div class="px-2 w-full bg-gradient-to-r from-black via-black to-teal-500 rounded-b-lg">
                                    <p class="font-semibold text-left text-white capitalize lg:text-md">{{$brand->name}}</p>
                                </div>
                            </button>

                            @if($brand->page)
                                <div class="mt-4">
                                    <a href="{{ route('preview',$brand->page->id) }}"
                                       class="border-teal-500 hover:border-b"
                                    >Learn More</a>
                                </div>
                            @else
                                <div class="py-2">
                                    <a href="#"
                                       class="invisible"
                                    >Learn More</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </div>


    <div
        class="overflow-hidden pb-6 mx-auto sm:px-6 lg:px-8"
    >

        <div class="overflow-hidden py-4 px-3 mx-auto md:px-0">
            {{ $this->filteredProducts->links() }}
        </div>

        <h2 class="sr-only">Products</h2>

        <div class="grid grid-cols-2 gap-x-2 gap-y-4 -mx-px sm:mx-0 md:grid-cols-4 lg:grid-cols-6 lg:gap-4 lg:gap-y-6">
            @forelse($this->filteredProducts as $product)
                <x-products.card :product="$product" />
            @empty
                <div class="flex col-span-2 justify-center items-center h-72 lg:col-span-6">
                    <div class="text-center">
                        <h3 class="text-4xl font-extrabold text-slate-700">WHOOPS!</h3>
                        <p class="text-lg text-slate-500">
                            Looks like we have no results found based on your filter or search!
                        </p>

                        <div class="mt-6">
                            <button
                                class="px-1 bg-gray-200 rounded-lg border shadow hover:bg-gray-100"
                                x-on:click="$dispatch('clear-search-filters')"
                            >
                                <div class="flex items-center space-x-4">
                                    <p>Clear your filters & try again</p>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-4 h-4 text-pink-600 animate-pulse"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59"
                                        />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="overflow-hidden py-4 px-3 mx-auto md:px-0">
            {{ $this->filteredProducts->links() }}
        </div>

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

    {{--  @if($selectedProduct)--}}
    {{--    <x-modal--}}
    {{--        title="Add to cart"--}}
    {{--        name="add-to-cart-modal"--}}
    {{--        x-cloak--}}
    {{--    >--}}
    {{--      --}}
    {{--      <div>--}}
    {{--        <div class="py-4">--}}
    {{--          <h2--}}
    {{--              class="text-sm font-semibold text-gray-600"--}}
    {{--          --}}
    {{--          >Qty required:--}}
    {{--            <span>{{ $qty }} / {{$selectedProductQtyAvailable}}</span>--}}
    {{--          </h2>--}}
    {{--        </div>--}}
    {{--        <div class="flex items-center space-x-4">--}}
    {{--          <div>--}}
    {{--            <div lass="pb-1">--}}
    {{--              <label--}}
    {{--                  for="qty"--}}
    {{--                  class="text-gray-500 text-[12px]"--}}
    {{--              >Qty Required</label>--}}
    {{--            </div>--}}
    {{--            <input--}}
    {{--                class="w-32 rounded"--}}
    {{--                type="number"--}}
    {{--                wire:model.live="qty"--}}
    {{--                id="qty"--}}
    {{--                min="1"--}}
    {{--                max="{{ $selectedProductQtyAvailable }}"--}}
    {{--            >--}}
    {{--          </div>--}}
    {{--          --}}
    {{--          @if($selectedProduct->stocks_sum_qty >= 5)--}}
    {{--            <div>--}}
    {{--              <div lass="pb-1">--}}
    {{--                <label--}}
    {{--                    for="qty"--}}
    {{--                    class="text-gray-500 text-[12px]"--}}
    {{--                >Add 5 Units</label>--}}
    {{--              </div>--}}
    {{--              <x-button--}}
    {{--                  class="py-2 w-32 text-center button-green"--}}
    {{--                  wire:click="$set('qty',5)"--}}
    {{--              >--}}
    {{--                + 5--}}
    {{--              </x-button>--}}
    {{--            </div>--}}
    {{--          @endif--}}
    {{--          --}}
    {{--          @if($selectedProductQtyAvailable >= 10)--}}
    {{--            <div>--}}
    {{--              <div lass="pb-1">--}}
    {{--                <label--}}
    {{--                    for="qty"--}}
    {{--                    class="text-gray-500 text-[12px]"--}}
    {{--                >Add 10 Units</label>--}}
    {{--              </div>--}}
    {{--              <x-button--}}
    {{--                  class="py-2 w-32 text-center button-green"--}}
    {{--                  wire:click.prevent="$set('qty',10)"--}}
    {{--              >--}}
    {{--                + 10--}}
    {{--              </x-button>--}}
    {{--            </div>--}}
    {{--          @endif--}}
    {{--          --}}
    {{--          <div>--}}
    {{--            <div class="pb-1">--}}
    {{--              <label--}}
    {{--                  for="qty"--}}
    {{--                  class="text-gray-500 text-[12px]"--}}
    {{--              >Add All</label>--}}
    {{--            </div>--}}
    {{--            <x-button--}}
    {{--                class="py-2 w-32 text-center button-green"--}}
    {{--                wire:click="$set('qty',{{ $selectedProductQtyAvailable }})"--}}
    {{--            >--}}
    {{--              + {{ $selectedProductQtyAvailable }}--}}
    {{--            </x-button>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--        <div class="mt-4">--}}
    {{--          <x-button--}}
    {{--              class="py-2 px-4 text-center button-green w-fit"--}}
    {{--              x-on:click="$dispatch('add-to-cart',{ product: {{$selectedProduct}}, qty: {{$qty}} })"--}}
    {{--          >--}}
    {{--            ADD TO CART--}}
    {{--          </x-button>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    --}}
    {{--    </x-modal>--}}
    {{--  @endif--}}
</div>
