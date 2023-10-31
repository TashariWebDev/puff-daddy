<div
    class="overflow-y-auto fixed top-0 left-0 w-full h-auto min-h-screen bg-white shadow lg:w-72 z-[9999]"
    x-data="{show: false,activeTab: 'brands'}"
    x-show="show"
    x-transition
    x-on:click.outside="show = false"
    x-on:show-filters.window="show = !show"
>
  
  <div class="flex justify-end items-center px-3">
    <button x-on:click="show = false">
      <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6 text-pink-600"
      >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
    
    </button>
  </div>
  
  <div class="px-3 mt-6">
    <h2 class="text-lg font-bold">Product Filters</h2>
  </div>
  
  <div class="px-3 mt-6">
    <button
        class="px-1 text-sm font-bold bg-gray-200 rounded border shadow"
        x-on:click="$dispatch('clear-search-filters')"
    >
      <div class="flex items-center space-x-4">
        <p>Reset all filters</p>
        <div>
          <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-3 h-3 text-pink-600"
          >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </div>
      </div>
    </button>
  </div>
  
  <div class="mt-6">
    <h2 class="px-3 font-semibold">Product Status</h2>
    
    <div class="overflow-y-scroll relative mt-3 h-auto">
      <div class="px-3">
        <div class="flex items-center pb-3 space-x-4">
          <input
              type="radio"
              id="status"
              value="0"
              class="w-6 h-6 rounded-full"
              wire:model.live="status"
          >
          <label
              for="status"
              class="text-sm uppercase"
          >
            Show all
          </label>
        </div>
        <div class="flex items-center pb-3 space-x-4">
          <input
              type="radio"
              id="status"
              value="1"
              class="w-6 h-6 rounded-full"
              wire:model.live="status"
          >
          <label
              for="status"
              class="text-sm uppercase"
          >
            Show only in stock
          </label>
        </div>
      </div>
    </div>
  </div>
  
  <div class="mt-6">
    <button
        class="flex justify-between items-center py-2 px-2 w-full bg-gray-50 rounded-sm shadow"
        x-on:click="activeTab = 'brands' "
    >
      <h2 class="px-3 font-semibold">Filter by brand</h2>
      <x-icons.arrow-down class="w-4 h-4"/>
    </button>
    
    <div
        class="overflow-y-scroll relative mt-3 h-72"
        x-show="activeTab == 'brands'"
    >
      <div
          class="px-3"
      >
        @foreach($brands as $brand)
          <div class="flex items-center pb-3 space-x-4">
            <input
                type="radio"
                value="{{ $brand }}"
                id="{{ $brand }}"
                class="w-6 h-6 rounded-full"
                wire:model.live="selectedBrand"
            >
            <label
                for="brand"
                class="text-sm uppercase"
            >
              {{ $brand }}
            </label>
          </div>
        @endforeach
      </div>
      <div class="sticky bottom-0 h-12 bg-gradient-to-t from-white to-transparent group">
        <button class="block flex justify-end items-center px-1 w-full h-full group-hover:bg-white/50">
          <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-4 h-4 group-hover:animate-bounce"
          >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
  
  <div class="mt-6">
      <button
          class="flex justify-between items-center py-2 px-2 w-full bg-gray-50 rounded-sm shadow"
          x-on:click="activeTab = 'categories' "
      >
      <h2 class="px-3 font-semibold">Filter by category</h2>
      <x-icons.arrow-down class="w-4 h-4"/>
    </button>
    
    <div
        class="overflow-y-scroll relative mt-3 h-72"
        x-show="activeTab == 'categories'"
    >
      <div
          class="px-3"
      >
        @foreach($categories as $category)
          <div class="flex items-center pb-3 space-x-4">
            <input
                type="radio"
                value="{{ $category }}"
                id="{{ $category }}"
                class="w-6 h-6 rounded-full"
                wire:model.live="selectedCategory"
            >
            <label
                for="category"
                class="text-sm uppercase"
            >
              {{ $category }}
            </label>
          </div>
        @endforeach
      </div>
      <div class="sticky bottom-0 h-12 bg-gradient-to-t from-white to-transparent group">
        <button class="block flex justify-end items-center px-1 w-full h-full group-hover:bg-white/50">
          <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-4 h-4 group-hover:animate-bounce"
          >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</div>
