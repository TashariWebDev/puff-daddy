<x-mail-layout>
    <div class="px-4 pt-10 w-full">
        <p class="text-lg font-bold">Hi {{ $order->customer->name }}</p>
        <p class="text-lg">
            Please find attached invoice as requested
        </p>
        <p>
            Thank you for your support!
        </p>
    </div>
</x-mail-layout>
