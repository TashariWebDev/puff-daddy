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
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-bold">Thank you for placing your order with us.</h1>
                    
                    <div class="pt-6">
                        <p>Our team will be process it once payment has been received.</p>
                        <p>Please make payment via EFT to the account below and forward a POP
                           to {{ $company->email_address }}.
                        </p>
                    </div>
                    
                    <div class="pt-6">
                        <ul>
                            <li><span class="font-bold">Name :</span> {{ $company->bank_account_name }}</li>
                            <li><span class="font-bold">Bank :</span> {{ $company->bank_name }}</li>
                            <li><span class="font-bold">Branch :</span> {{ $company->bank_branch }}</li>
                            <li><span class="font-bold">Account :</span> {{ $company->bank_account_no }}</li>
                            <li><span class="font-bold">Br. Code :</span> {{ $company->bank_branch_no }}</li>
                            <li><span class="font-bold">Reference :</span> Order Number</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
