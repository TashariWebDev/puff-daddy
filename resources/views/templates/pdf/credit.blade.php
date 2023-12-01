@php use App\Models\SystemSetting; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>Credit Note</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"
    >
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {

            /*section,*/
            /*td,*/
            /*tr,*/
            /*div,*/
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
    <div class="p-2 w-screen font-sans antialiased bg-white">
        <div class="p-6 bg-white rounded">
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
                            <li class="font-extrabold text-teal-500 uppercase">CREDIT NOTE</li>
                            <li class="font-semibold leading-tight uppercase whitespace-nowrap text-[10px]">{{ $credit->created_at->format('d-m-y') }}</li>
                            <li class="font-semibold leading-tight uppercase text-[10px]">
                                {{ $credit->number }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="grid grid-cols-2 py-2 space-x-2">
                    <div>
                        <div class="px-1 bg-gray-100 rounded">
                            <p class="font-bold uppercase text-[10px]">Details:</p>
                        </div>
                        <ul class="py-2 px-1">
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">
                                    {{ ucwords($credit->customer->name) }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">{{ $credit->customer->phone }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">{{ $credit->customer->email }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">
                                    {{ ucwords($credit->customer->company) }}</p>
                            </li>
                            <li>
                                <p class="leading-tight text-[10px] text-slate-900">
                                    {{ ucwords($credit->customer->vat_number) }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <div id="body">

                <table class="w-full">
                    <thead class="bg-gray-100 rounded-t">
                        <tr>
                            <th class="font-bold leading-snug text-left uppercase text-[10px]">SKU
                            </th>
                            <th
                                class="col-span-2 font-bold leading-snug text-left uppercase text-[10px]"
                            >
                                Item
                            </th>
                            <th class="font-bold leading-snug text-right uppercase text-[10px]">Qty</th>
                            <th class="font-bold leading-snug text-right uppercase text-[10px]">Price
                            </th>
                            <th class="font-bold leading-snug text-right uppercase text-[10px]">
                                Discount
                            </th>
                            <th class="font-bold leading-snug text-right uppercase text-[10px]">Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($credit->items as $item)
                            <tr class="py-2 border-b border-gray-100 break-inside-avoid">

                                <td class="text-left">
                                    <p class="font-semibold uppercase text-[8px]">{{ $item->product->sku }}</p>
                                </td>

                                <td class="col-span-2 leading-tight text-left">
                                    <p class="font-bold leading-tight text-[10px]">
                                        {{ ucwords($item->product->brand) }} {{ ucwords($item->product->name) }}
                                    </p>
                                    <span class="flex flex-wrap leading-tight text-[10px]">
                                        @foreach ($item->product->features as $feature)
                                            <span
                                                class="pr-1 font-semibold leading-tight text-[8px]"
                                            >{{ ucwords($feature->name) }}</span>
                                        @endforeach
                                    </span>
                                </td>
                                <td class="text-right">
                                    <p class="text-[10px]">{{ $item->qty }}</p>
                                </td>
                                <td class="text-right">
                                    <p class="text-[10px]">
                                        R {{ number_format($item->price, 2) }}
                                    </p>
                                </td>
                                <td class="text-right">
                                    <p class="text-[10px]">
                                        R {{ number_format($item->discount, 2) }}
                                    </p>
                                </td>
                                <td class="text-right">
                                    <p class="text-[10px]">
                                        R {{ number_format($item->line_total, 2) }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><p class="text-[10px]">Delivery</p></td>
                            <td class="text-right">
                                <p class="text-[10px]">
                                    R {{ number_format($credit->delivery_charge, 2) }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right border-b border-gray-300 border-dashed">
                                <p class="font-bold text-[10px]">TOTAL</p></td>
                            <td class="text-right rounded border-b border-gray-300 border-dashed">
                                <p class="font-bold text-[10px]">
                                    R {{ number_format($credit->getTotal(), 2) }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right border-b border-gray-300 border-dashed"><p class="text-[10px]">VAT</p>
                            </td>
                            <td class="text-right border-b border-gray-300 border-dashed">
                                <p class="text-[10px]">
                                    R {{ number_format(vat($credit->getTotal()), 2) }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <section
                    class="pt-2 mt-6 break-before-avoid-page break-inside-avoid-page"
                    id="footer"
                >

                    <div class="grid grid-cols-3 pt-2 break-before-avoid-page break-inside-avoid-page">
                        <x-document.banking reference="{{ $credit->number }}" />
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
