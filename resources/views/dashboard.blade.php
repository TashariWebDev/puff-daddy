<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 gap-4 mx-auto max-w-7xl sm:px-6 lg:grid-cols-2 lg:px-8">

            <div class="overflow-hidden p-6 text-center text-gray-900 bg-white shadow-sm sm:rounded-lg">
                <h4 class="text-6xl">{{ auth()->user()->orders->where('status','!=',null)->count() }}</h4>
                <h5>ORDERS</h5>
            </div>

            <div class="overflow-hidden p-6 text-center text-gray-900 bg-white shadow-sm sm:rounded-lg">
                <h4 class="text-6xl">{{ auth()->user()->getRunningBalance() }}</h4>
                <h5>BALANCE</h5>
            </div>
        </div>
    </div>
</x-app-layout>
