<div
    class="p-2 rounded-lg border border-transparent shadow lg:p-2"
    wire:key="{{ $product->id }}"
>
  
  
  <a
      href="{{ route('detail',$product->id) }}"
      wire:navigate
      class="block overflow-hidden relative bg-white rounded-md aspect-w-1 aspect-h-1"
  >
    <img
        src="{{ $product->image }}"
        alt=""
        class="object-fill object-center w-full bg-contain rounded-md aspect-square"
    >
    @if($product->is_sale)
      <div class="absolute top-0 right-0 px-1 m-2 bg-pink-600 rounded-sm">
        <p class="font-bold text-white text-[10px]">SALE</p>
      </div>
    @endif
  </a>
  
  
  <div
      class="mt-6 w-full bg-white rounded-b-lg"
      title="{{ $product->brand }} {{ $product->name }}"
  >
    <a
        href="{{ route('detail',$product->id) }}"
        wire:navigate
    >
      <p class="text-xs font-bold whitespace-nowrap truncate">{{ $product->brand }} {{ $product->name }}</p>
      <div class="flex overflow-hidden flex-wrap py-1 leading-3 h-[34px]">
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
          <span class="pr-3 line-through"> R {{ number_format($product->getOldPrice(), 2) }}</span>
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
    
    <div class="mt-3">
      @if ($product->stocks_sum_qty > 0)
        <div class="flex space-x-0.5">
          <x-button
              class="flex justify-between items-center w-full button-green"
              x-on:click="$dispatch('add-to-cart',{ product: {{$product->id}}, qty: 1 })"
          >
            <p class="font-semibold whitespace-nowrap truncate">
              Buy Now
            </p>
            <div class="hidden lg:block">
              <x-icons.cart class="w-6 h-6 text-green-100 group-hover:text-green-900 group-hover:animate-wiggle"/>
            </div>
          </x-button>
        </div>
      @endif
      
      
      <div>
        @if ($product->stocks_sum_qty <= 0)
          <div x-data="{ show:false }">
            <x-button
                class="flex justify-between items-center w-full button-pink-alt"
                wire:click="showStockAlert('{{ $product->id }}')"
            >
              <p class="font-semibold whitespace-nowrap truncate">
                Set Alert
              </p>
              <div>
                <x-icons.bell class="w-6 h-6 text-pink-600 group-hover:text-pink-900 group-hover:animate-wiggle"/>
              </div>
            </x-button>
          </div>
        @endif
      </div>
    
    </div>
  </div>
</div>
