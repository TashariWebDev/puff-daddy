<x-mail-layout>
    
    <div class="px-4 pt-10 w-full">
        <p class="text-lg">
            You have received a new online order from {{ ucwords($customer->name) }}.
        </p>
        <div class="py-4">
            <p>
                Order number: {{ strtoupper($order->number) }}.
            </p>
            <p>
                Order total: R {{ strtoupper($order->getTotal()) }}.
            </p>
        </div>
    </div>

</x-mail-layout>
