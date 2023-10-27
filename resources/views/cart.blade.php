<x-base-layout>
  
  <div class="container p-6 py-24 mx-auto">
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
      
      <div class="lg:col-span-2">
        <livewire:pages.cart.item-list/>
      </div>
      
      <div>
        <livewire:pages.cart.checkout/>
      </div>
    
    </div>
  </div>

</x-base-layout>
