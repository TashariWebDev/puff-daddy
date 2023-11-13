<x-app-layout>
    
    @php
        $company = App\Models\SystemSetting::first();
    @endphp
    
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Order Confirmed
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if($success)
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="font-bold">Thank you for placing your order with us.</h1>
                        
                        <div class="pt-6">
                            <p>
                                We have received your payment of {{ number_format($this->order->getTotal(),2) }}
                            </p>
                            <p>Our team will be processing it once ASAP.</p>
                        </div>
                    
                    </div>
                </div>
            @else
                <div class="overflow-hidden bg-red-100 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="font-bold">
                            Whoops! Looks like we were unable to confirm your payment.
                        </h1>
                        
                        <div class="pt-6">
                            <p>
                                Please drop us an email or call us so that we can look into it.
                            </p>
                        </div>
                    
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
