<div class="p-6 bg-white rounded-lg">
  
  @if($balance > 0)
    <div class="justify-between items-start lg:flex">
      <p class="py-3 font-bold lg:py-0">Your current outstanding balance is R {{ $balance }}</p>
      
      <div>
        <form wire:submit="makePayment">
          <div class="flex">
            <div class="-mr-1">
              <input
                  type="number"
                  wire:model.live="amount"
                  class="font-semibold rounded-l border-gray-300"
                  placeholder="Enter Amount"
              >
            </div>
            <x-button class="button-green">Make Payment</x-button>
          </div>
        </form>
        <p class="py-1 text-xs text-gray-500">Settle full amount or enter a custom amount to pay</p>
      </div>
      
    </div>
  @endif
  
</div>
