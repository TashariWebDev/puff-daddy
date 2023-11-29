<x-base-layout>
    <div class="p-2 max-w-none lg:p-20 prose prose-teal prose-sm lg:prose-xl">
        
        <article class="break-keep">
            <h1 class="text-teal-400">Payment options</h1>
            <p>
                {{ config('app.name') }} has multiple payment options available for your convenience.
            </p>
            <ul class="list-none">
                <li>
                    <p class="font-bold">EFT - Pay using direct bank transfer</p>
                </li>
                <li>
                    <p class="font-bold">Yoco - Pay using your credit card or debit card</p>
                </li>
                <li>
                    <p class="font-bold">Ozow - Instant EFT - Pay directly out of your bank account.</p>
                </li>
            </ul>
            
            
            <h2>Card acquiring and security</h2>
            <p>
                Card transactions will be acquired for {{ config('app.name') }} via Yoco & Ozow who
                are the approved payment gateway for all
                South African Acquiring Banks. Yoco & Ozow uses the strictest form of encryption,
                namely Secure Socket Layer 3 (SSL3) and
                no Card details are stored on the website. Users may go to www.yoco.co.za or www.payflex.co.za to view
                their
                security
                certificate
                and security policy
            </p>
            <h2>Customer details separate from card details</h2>
            <p>
                Customer details will be stored by {{ config('app.name') }} separately from card details which are
                entered by the client on
                Yoco’s secure site.
            </p>
            <h2>Merchant Outlet country and transaction currency</h2>
            <p>
                The merchant outlet country at the time of presenting payment options to the
                cardholder is South Africa.
                Transaction currency is
                South African Rand (ZAR).
            </p>
        </article>
    
    </div>
</x-base-layout>
