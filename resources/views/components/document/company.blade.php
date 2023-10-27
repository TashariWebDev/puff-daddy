<div class="flex items-center pb-2 space-x-6 w-full">

    @if ($company->logo)
        <div>
            <img
                class="w-16"
                src="{{ asset('logo.png') }}"
                alt="{{ config('app.url') }}"
            >
        </div>
    @endif

    <div>
        <ul>
            <li class="font-extrabold uppercase text-[10px]">{{ ucwords($company->company_name) }}</li>
            <li class="font-semibold leading-tight text-[10px]">
                {{ $company->vat_registration_number }}
                </li>
            <li class="font-semibold leading-tight text-[10px]">{{ $company->phone }}</li>
            <li class="font-semibold leading-tight text-[10px]">{{ $company->email_address }}</li>
        </ul>
    </div>
</div>
