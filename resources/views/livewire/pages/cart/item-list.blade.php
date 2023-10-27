<div>
  
  <div class="mb-4">
    <h1 class="text-lg font-bold">Shopping Cart</h1>
    <p class="text-sm text-gray-500">Please confirm your purchase below.</p>
  </div>
  
  <div class="p-4 bg-white rounded-lg border">
    @foreach($order->items as $item)
      <livewire:pages.cart.items
          :$item
          :key="$item->id.'-'.time()"
      />
    @endforeach
  </div>


</div>
