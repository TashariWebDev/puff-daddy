<x-mail-layout>

    <div class="px-4 pt-10 w-full">
        <p class="text-lg">
            You have received a new online payment.
        </p>
        <div class="py-6">
            <p>Customer: {{ $order->customer->name }}</p>
            <p>Order number: {{ strtoupper($order->number) }}</p>
            <p>Amount: R {{ (0 - $transaction->amount) }}</p>
            <p>Gateway: {{ ucwords($createdBy) }}</p>
        </div>

    </div>


</x-mail-layout>
