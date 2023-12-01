<div>
    <ul class="text-left">
        <li class="font-extrabold uppercase text-[10px]">{{ ucwords($company->company_name) }}</li>
        <li class="font-semibold leading-tight text-[10px]">
            {{ $company->vat_registration_number }}
        </li>
        <li class="font-semibold leading-tight text-[10px]">{{ $company->phone }}</li>
        <li class="font-semibold leading-tight text-[10px]">{{ $company->email_address }}</li>
    </ul>
</div>
