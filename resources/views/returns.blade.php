@php use App\Models\SystemSetting; @endphp
<x-base-layout>
    @php
        $company  = App\Models\SystemSetting::first() ?? new SystemSetting();
    @endphp

    <div class="p-2 max-w-none lg:p-20 prose prose-teal prose-sm lg:prose-xl">

        <article class="break-keep">
            <h1 class="text-teal-400">Returns policy</h1>

            <h2 class="font-bold">
                Warranty period of all DISPOSABLE products is 24HRS from the time of purchase.
            </h2>

            <h3>
                IF THERE ARE ANY QUALITY PROBLEMS FOUND DURING THE WARRANTY PERIOD:
            </h3>

            <p>
                For products bought from {{ config('app.name') }}, you need to provide the order number, and a photo or
                a video showing the defects of the product to our customer service team:
                {{ $company->email_address }}.
                If it passed the genuine check, and it is confirmed that the damage is caused by non-human factors, you
                will be given a free replacement product.
            </p>

            <p>
                For products bought from other retail stores, we recommend you seek help where you purchased it. If the
                store is unable to provide any assistance or after-sales service, you can turn to us for help. This
                requires providing the product’s security code which can be found on the packaging, and a photo or a
                video showing the defects of the product to our customer service team: {{ $company->email_address }}.If
                it passed the genuine check, and it is confirmed that the damage is caused by non-human factors, you
                will be given a free replacement product.
            </p>

            <p>
                We won’t charge you for your first replacement product, but please understand that we need to charge
                shipping fees for your second replacement product of the same original device, and in case there is a
                third replacement request, we can only offer you a 50% off discount for the particular product.
            </p>

            <h3>Refunds</h3>

            <p>
                Once your return is received and inspected, we will send you an email_address to notify you that we have
                received your returned item. We will also notify you of the approval or rejection of your refund.
            </p>

            <p>
                If you are approved, then your refund will be processed, and a credit will automatically be applied to
                your credit card or original method of payment, within a certain amount of days.
            </p>

            <h3> Late or missing refunds</h3>
            <p>
                If you haven’t received a refund yet, first check your bank account again.
            </p>
            <p>
                Then contact your credit card company, it may take some time before your refund is officially posted.
            </p>
            <p>
                Next contact your bank. There is often some processing time before a refund is posted.
            </p>
            <p>
                If you’ve done all of this and you still have not received your refund yet, please contact us
                at {{ $company->email_address }}
            </p>

            <h3>Sale items</h3>
            <p>
                Only regular priced items may be refunded. Sale items cannot be refunded.
            </p>

            <h3>Exchanges</h3>
            <p>
                We only replace items if they are defective or damaged. If you need to exchange it for the same item,
                send us an email at {{ $company->email_address }}.
            </p>


            <h3>Shipping returns</h3>
            <p>
                You will be responsible for paying for your own shipping costs for returning your item. Shipping costs
                are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your
                refund.
            </p>
            <p>
                Depending on where you live, the time it may take for your exchanged product to reach you may vary.
            </p>
            <p>
                If you are returning more expensive items, you may consider using a trackable shipping service or
                purchasing shipping insurance. We don’t guarantee that we will receive your returned item.
            </p>
        </article>

    </div>

</x-base-layout>
