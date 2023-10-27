<div>
  
  <div>
    <div class="py-4">
      {{ $transactions->links() }}
    </div>
  </div>
  
  <div>
    <table class="hidden w-full lg:inline-table">
      
      <thead>
        <tr class="border-b-2">
          <th class="py-6 text-left">Transaction</th>
          <th class="py-6 text-left">Reference</th>
          <th class="py-6 text-right">Total</th>
          <th class="py-6 text-right">Balance</th>
          <th class="hidden py-6 text-right lg:block">Actions</th>
        </tr>
      </thead>
      
      <tbody>
        @foreach($transactions as $transaction)
          <tr class="py-4 text-sm font-bold text-gray-600 lg:pb-2 lg:border-b">
            
            <td class="py-4">
              <p>{{ $transaction->id }} {{ strtoupper($transaction->type) }}</p>
              <p class="text-xs text-gray-500">{{ $transaction->created_at }}</p>
            </td>
            
            <td>
              <p>{{ strtoupper($transaction->reference) }}</p>
              <p>{{ $transaction->created_by }}</p>
            </td>
            
            <td class="text-right">
              {{ number_format($transaction->amount, 2) }}
            </td>
            
            <td class="text-right">
              {{ number_format($transaction->running_balance, 2) }}
            </td>
            
            <td class="hidden justify-end items-center py-2 space-x-2 text-right lg:flex">
              <x-button
                  class="flex justify-center items-center space-x-2 lg:w-10 button-green"
                  wire:click="print('{{ $transaction->id }}')"
                  wire:loading.attr="disabled"
                  wire:target="print('{{ $transaction->id }}')"
              >
                <x-icons.print class="w-4 h-4"/>
              </x-button>
            </td>
            
          </tr>
          
          {{-- Mobile--}}
          
          <div class="grid grid-cols-2 text-sm text-gray-600 lg:hidden text-bold">
            
            <div class="col-span-2 py-3">
              <p class="text-xs font-semibold">{{ $transaction->id }} {{ strtoupper($transaction->type) }}</p>
              <p class="text-xs text-gray-500">{{ $transaction->created_at }}</p>
              <p class="text-xs font-semibold">{{ strtoupper($transaction->reference) }}</p>
              <p class="text-xs text-gray-400">{{ $transaction->created_by }}</p>
            </div>
            
            <div class="py-3">
              <p>
                <span class="text-xs font-semibold">AMT:</span> {{ number_format($transaction->amount, 2) }}
              </p>
            </div>
            
            <div class="py-3 text-right">
              <p>
                <span class="text-xs font-semibold">BAL:</span> {{ number_format($transaction->running_balance, 2) }}
              </p>
            </div>
            
            <div class="col-span-2">
              <x-button
                  class="flex justify-center items-center space-x-2 w-full text-white button-green"
                  wire:click="print('{{ $transaction->id }}')"
                  wire:loading.attr="disabled"
                  wire:target="print('{{ $transaction->id }}')"
              >
                <x-icons.print class="w-4 h-4 text-white"/>
              </x-button>
            </div>
          
          </div>
        @endforeach
      </tbody>
    </table>
  </div>
  
  <div class="py-4">
    {{ $transactions->links() }}
  </div>
</div>
