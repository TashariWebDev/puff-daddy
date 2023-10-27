<x-modal
    title="Set stock alert"
    name="stock-alerts"
>
  
  <div class="my-6">
    <p class="font-bold text-gray-600">
      We will email you as soon as {{ $product->brand }} {{ $product->name }} is re-stocked
    </p>
  </div>
  
  <form wire:submit="saveStockAlert">
    <div class="mt-4">
      <label for="email"
             :value="__('Email')"
      >
        Enter your email
      </label>
      <input id="email"
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
        
        <x-icons.bell class="w-6 h-6 text-green-100 group-hover:text-green-800 group-hover:animate-wiggle"/>
      </x-button>
    </div>
  </form>
</x-modal>
