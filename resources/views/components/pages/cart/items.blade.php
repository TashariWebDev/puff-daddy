<div
    class="flex justify-between py-3 border-b"
>
  <div class="flex items-center space-x-4">
    <div>
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
          class="font-semibold hover:text-pink-600 hover:underline"
      >
        {{ $item->product->brand }} {{ $item->product->name }}
      </a>
      <div class="flex space-x-2">
        @foreach($item->product->features as $feature)
          <p class="text-xs">{{ $feature->name }}</p>
        @endforeach
      </div>
      <button
          wire:click="removeItem('{{ $item->id }}')"
          class="text-pink-600 hover:text-pink-700 text-[12px]"
      >
        remove
      </button>
    </div>
  </div>
  
  <div class="flex space-x-4">
    <div class="grid grid-cols-3">
      <div class="flex col-span-2 justify-center items-center">
        <input
            type="number"
            class="w-32 rounded-2xl shadow"
            value="{{ $item->qty }}"
            min="1"
            max="{{ $item->product->stocks->sum('qty') }}"
            wire:change.debounce="updateQty('{{ $item->id }}',$event.target.value)"
        >
      </div>
      <div class="flex justify-center items-center">
        <p> / {{ $item->product->stocks->sum('qty') }}</p>
      </div>
    </div>
    <div class="flex justify-end items-center w-48">
      <p>{{ number_format($item->line_total,2) }}</p>
    </div>
  </div>
</div>
