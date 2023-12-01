@php use App\Models\SystemSetting; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>Invoice</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"
    >
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @media print {
            section {
                page-break-inside: avoid !important;
            }

            @page {
                margin-top: 3mm;
                margin-bottom: 0;
                size: a4 portrait;
            }

            @page :first {
                margin-top: 3mm;
                margin-bottom: 0;
                size: a4 portrait;
            }
        }
    </style>
</head>

<body>
    <div class="overflow-hidden w-screen font-sans antialiased bg-white">
        <div class="flex flex-col p-6 min-h-screen bg-white rounded">
            <section id="header">
                <div class="grid grid-cols-2 space-x-2">
                    <div>
                        <img src="{{ asset('assets/full-logo.png') }}"
                             alt=""
                             class="w-48"
                        >
                    </div>
                    <div class="flex justify-between items-end p-1 space-x-8 bg-gray-100 rounded text-[10px]">
                        <x-document.company />
                        <ul class="text-right">
                            <li class="font-extrabold text-teal-500 uppercase">{{ $transaction->type }}</li>
                            <li class="font-semibold leading-tight uppercase text-[10px]">
                                {{ $transaction->created_at->format('d-m-y') }}
                            </li>
                            <li class="font-semibold leading-tight uppercase text-[10px]">
                                {{ $transaction->number }}
                            </li>
                            <li class="font-semibold leading-tight uppercase text-[10px]">
                                {{ $transaction->created_by }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="grid grid-cols-2 py-2 space-x-2">
                    <div>
                        <div class="px-1 bg-gray-100 rounded">
                            <p class="font-bold uppercase text-[10px]">Invoice To:</p>
                        </div>
                        <ul class="py-2 px-1">
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">
                                    {{ ucwords($transaction->customer->name) }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">{{ $transaction->customer->phone }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">{{ $transaction->customer->email }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">
                                    {{ ucwords($transaction->customer->company) }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">
                                    {{ ucwords($transaction->customer->vat_number) }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            
            <div id="body">
                
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="font-bold leading-snug text-left uppercase text-[10px]">ID
                            </th>
                            <th
                                class="col-span-2 font-bold leading-snug text-left uppercase text-[10px]"
                            >
                                Date
                            </th>
                            <th class="font-bold leading-snug text-left uppercase text-[10px]">
                                Reference
                            </th>
                            <th class="font-bold leading-snug text-right uppercase text-[10px]">Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="py-1 break-inside-avoid">
                            
                            <td class="text-left">
                                <p class="font-semibold uppercase text-[10px]">
                                    {{ $transaction->id }}
                                </p>
                            </td>
                            
                            <td class="col-span-2 text-left">
                                <p class="text-[10px]">
                                    {{ $transaction->date?->format('d-m-y') ?? $transaction->created_at?->format('d-m-y') }}
                                </p>
                            </td>
                            <td class="text-left">
                                <p class="text-[10px]">{{ $transaction->reference }}</p>
                            </td>
                            <td class="text-right">
                                <p class="text-[10px]">
                                    R {{ number_format($transaction->amount, 2) }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
