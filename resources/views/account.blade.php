<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Account') }}
    </h2>
  </x-slot>
  
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      
      <div lass="p-6 text-gray-900 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <livewire:pages.account.payment/>
      </div>
      
      <div class="overflow-hidden mt-3 bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <livewire:pages.account.transactions.table/>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
