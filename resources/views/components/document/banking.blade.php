<div>
    <div class="px-1">
        <p class="font-bold uppercase text-[10px]">Banking Details</p>
    </div>
    <ul class="p-1">
        <li class="font-semibold leading-tight text-[10px]">{{ ucwords($company->bank_name) }}</li>
        <li class="font-semibold leading-tight text-[10px]">{{ ucwords($company->bank_account_name) }}</li>
        <li class="font-semibold leading-tight text-[10px]">
            {{ ucwords($company->bank_branch) }} - {{ ucwords($company->bank_branch_no) }}
        </li>
        <li class="font-semibold leading-tight text-[10px]">ACC: {{ ucwords($company->bank_account_no) }}</li>
        <li class="leading-tight text-[10px]">REF: {{ $reference}}</li>
    </ul>
</div>
