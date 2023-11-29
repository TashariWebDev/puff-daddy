@php
    $deliveryOptions = App\Models\Delivery::whereCustomerType('retail')->orderBy('province')->get();
@endphp
<x-base-layout>
    <div class="p-2 max-w-none lg:p-20 prose prose-teal prose-sm lg:prose-xl">
        
        <article class="p-4 break-keep">
            <h1 class="text-teal-400">Delivery options</h1>
            <p>
                {{ config('app.name') }} has multiple delivery options available for your convenience.
            </p>
            
            <div>
                <h2>Estimated Courier rates - Retail Orders</h2>
            </div>
            
            <div class="flow-root p-2 mt-8 lg:w-1/2 prose-sm lg:prose-lg">
                <div class="overflow-x-auto -my-2 -mx-4 sm:-mx-6 lg:-mx-8 no-scrollbar">
                    <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr class="bg-white">
                                    <th>
                                        <p class="pl-2">Type</p>
                                    </th>
                                    <th><p>Province</p></th>
                                    <th><p>Price</p></th>
                                    <th class="text-right whitespace-nowrap">
                                        <p class="pr-2">Min Spend for Free Delivery</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="font-semibold divide-y divide-gray-200">
                                @foreach($deliveryOptions as $option)
                                    <tr class="bg-white even:bg-gray-300">
                                        <td class="whitespace-nowrap">
                                            <p class="pl-2">{{ $option->description }}</p>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <p class="capitalize">{{ $option->province }}</p>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            @if($option->price == 0)
                                                <p class="text-extrabold">FREE</p>
                                            @endif
                                            
                                            @if($option->price > 0)
                                                <p>From R {{ number_format($option->price,2) }}</p>
                                            @endif
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            @if($option->waiver_value == 0)
                                                <p class="pr-2 text-extrabold">N/A</p>
                                            @endif
                                            
                                            @if($option->price > 0)
                                                <p class="pr-2">
                                                    R {{ number_format($option->waiver_value,2) }}
                                                </p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div>
                <p>** Bulk / Wholesale orders will be calculated at checkout</p>
                <p>** Prices are quoted on delivery to main city centers as listed below</p>
                <p>** Outlying or regional areas may carry a higher cost</p>
                <p>** Rates exclude delivery to plots, farms, embassies and chain stores.</p>
            </div>
            
            <div>
                <h4>Main City Centers (Gauteng)</h4>
                <p>
                    Areas included: Pretoria (Rosslyn down to Moreleta Park), Centurion, Midrand, Sandton, Johannesburg
                    (covering Krugersdorp, Brackenhurst up to Benoni
                </p>
                
                <h4> Main City Centers (National)</h4>
                <p>
                    Areas included: Cape Town, Durban, Bloemfontein, East London, George, Kimberely, Ladysmith,
                    Nelspruit, Pietersburg, Port Elizabeth, Potchefstroom, Welkom, Witbank.
                </p>
                
                <h4>
                    Outlying or regional
                </h4>
                <p>
                    Gauteng Areas included: Brits, Hartbeesport, Rustenburg, Randfontein, Carletonville, Westonaria,
                    Vereeniging, Parys, Vanderbijlpark, Brakpan, Springs & Nigel. National: all areas not listed under
                    Main City Centers (National)
                </p>
            </div>
        
        </article>
    
    </div>
</x-base-layout>
