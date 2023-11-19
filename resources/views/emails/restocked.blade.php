<x-mail-layout>

    <div class="px-4 pt-10 w-full">
        <p class="text-lg">
            Hi {{ ucwords($customer->name) }}.
        </p>
        <div class="py-4">
            <p>
                Just letting you know that we have received stock of {{ ucwords($brand->name) }}.
            </p>
            <p>
                Place your order now to avoid disappointment.
            </p>
        </div>
    </div>

</x-mail-layout>
