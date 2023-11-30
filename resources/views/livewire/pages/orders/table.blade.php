<div>
    
    <div>
        
        <div>
            <input
                type="text"
                wire:model.live="searchQuery"
                class="w-full rounded lg:w-64"
                autofocus
                placeholder="search"
            >
        </div>
        
        <div class="py-4">
            {{ $orders->links() }}
        </div>
    </div>
    
    <div>
        <table class="w-full">
            
            <thead>
                <tr class="border-b-2">
                    <th class="py-6 text-left">Date</th>
                    <th class="py-6 text-left">Inv. No.</th>
                    <th class="py-6 text-center">Status</th>
                    <th class="py-6 text-right">Total</th>
                    <th class="hidden py-6 text-right lg:block">Actions</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($orders as $order)
                    <tr class="py-4 text-gray-600 lg:pb-2 lg:border-b">
                        <td class="py-4 text-sm font-bold">{{ $order->created_at->format("d M Y") }}</td>
                        
                        <td>
                            <p class="text-sm font-bold">{{ $order->number }}</p>
                        </td>
                        
                        <td class="text-center">
                            <p class="px-1 text-sm font-bold capitalize">{{ $order->status }}</p>
                        </td>
                        
                        <td class="text-sm font-bold text-right">
                            R{{ number_format($order->getTotal(),2) }}
                        </td>
                        
                        <td class="hidden justify-end items-center py-2 space-x-2 text-right lg:flex">
                            
                            <x-button
                                class="flex justify-center items-center space-x-2 w-12 button-green"
                                wire:click="print('{{ $order->id }}')"
                                wire:loading.attr="disabled"
                                wire:target="print('{{ $order->id }}')"
                            >
                                <x-icons.print class="w-4 h-4" />
                            </x-button>
                            
                            <x-button
                                class="flex justify-center items-center space-x-2 w-12 button-green"
                                wire:click="download('{{ $order->id }}')"
                                wire:loading.attr="disabled"
                                wire:target="download('{{ $order->id }}')"
                            >
                                <x-icons.download class="w-4 h-4" />
                            </x-button>
                            
                            <x-button
                                class="flex justify-center items-center space-x-2 w-12 button-green"
                                wire:click="email('{{ $order->id }}')"
                                wire:loading.attr="disabled"
                                wire:target="email('{{ $order->id }}')"
                            >
                                <x-icons.mail class="w-4 h-4" />
                            </x-button>
                        </td>
                    </tr>
                    
                    <tr class="py-3 border-b lg:hidden">
                        <td>
                            <x-button class="flex justify-center items-center w-full button-green">
                                <x-icons.print class="w-4 h-4" />
                            </x-button>
                        </td>
                        <td>
                            <x-button class="flex justify-center items-center w-full button-green">
                                <x-icons.download class="w-4 h-4" />
                            </x-button>
                        </td>
                        <td>
                            <x-button class="flex justify-center items-center w-full button-green">
                                <x-icons.mail class="w-4 h-4" />
                            </x-button>
                        </td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="py-4">
        {{ $orders->links() }}
    </div>
</div>
