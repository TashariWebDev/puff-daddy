<div class="justify-between pb-4 mb-4 lg:flex">
  <div class="flex items-center space-x-2">
    <div class="w-24">
      <img src="{{ $this->item->product->image }}"
           alt=""
           class="object-contain w-20 h-20 bg-gray-50 rounded-full"
      >
    </div>
    <div>
      <a href="{{ route('detail',$this->item->product->id) }}"
         wire:navigate
         class="font-bold hover:text-red-600 hover:underline"
      >
        {{ $this->item->product->brand }} {{ $this->item->product->name }}
      </a>
      <div class="flex space-x-2">
        @foreach($this->item->product->features as $feature)
          <p class="text-xs">{{ $feature->name }}</p>
        @endforeach
      </div>
      <button
          wire:click="$dispatch('remove-item', { itemId: {{ $this->item->id }} })"
          class="text-red-600 hover:text-red-700 text-[12px]"
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
            value="{{ $this->item->qty }}"
            min="1"
            max="{{ $this->item->product->stocks->sum('qty') }}"
            wire:change.debounce="$dispatch('update-qty', { itemId: {{ $this->item->id }}, qty: $event.target.value })"
        >
      </div>
      <div class="flex justify-center items-center">
        <p> / {{ $this->item->product->stocks->sum('qty') }}</p>
      </div>
    </div>
    <div class="flex justify-end items-center w-48">
      <p class="font-bold">{{ number_format($this->item->line_total,2) }}</p>
    </div>
  </div>
</div>
