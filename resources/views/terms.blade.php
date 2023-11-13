<x-base-layout>
    @php
      $company  = App\Models\SystemSetting::first();
    @endphp
  <div class="p-2 max-w-none lg:p-20 prose prose-teal prose-sm lg:prose-xl">

    <article class="break-keep">
        <h1 class="text-teal-400">Terms and conditions</h1>
        <h3>Detailed description of goods and/or services</h3>

        <p>
            {{ config('app.name') }}
          is a business in the Vape industry that distributes and sells all Vape related products
        </p>

        <h3>Merchant Outlet country and transaction currency</h3>
          <p>
            The merchant outlet country at the time of presenting payment options to the
            cardholder is South Africa. Transaction currency is South African Rand (ZAR).
        </p>
        <h3>Responsibility</h3>
          <p>
            {{ config('app.name') }}
            takes responsibility for all aspects relating to the transaction
            including sale of goods and services sold on this website, customer service and
            support,
            dispute resolution and delivery of goods.
        </p>
        <h3>Country of domicile</h3>
          <p>
            This website is governed by the laws of South Africa and {{ config('app.name') }} chooses
            as its domicilium citandi et executandi for all purposes under this agreement,
            whether in respect of court process, notice, or other documents or
            communication of whatsoever nature, .
        </p>
        <h3>Variation</h3>
          <p>
            {{ config('app.name') }}
            may, in its sole discretion, change this agreement or any part
            thereof at any time without notice.
        </p>
        <h3>Company information</h3>
          <p>
            This website is run by {{ $company->company_name }} Ltd based in South Africa trading as
            {{ config('app.name') }} and with registration number {{ $company->company_registration_number }}.
        </p>
        <h3>Contact details</h3>
          <p>Physical address:</p>
        <address>
            {{ $company->address_line_one }} {{ $company->address_line_two }} {{ $company->suburb }}
          {{ $company->city }} {{ $company->province }} {{ $company->country }} {{ $company->postal_code }}
        </address>
        <p>Telephone: {{ $company->phone }}</p>
        <p>email: {{ $company->email }}</p>

        <h3>Customer accounts</h3>
          <p>
            When you create an account with us, you must provide us information that is accurate, complete, and current
            at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination
            of
            your account on our Service.
        </p>
        <p>
            You are responsible for safeguarding the password that you use to access the Service and for any activities
            or actions under your password, whether your password is with our Service or a third-party service.
        </p>
        <p>
            You agree not to disclose your password to any third party. You must notify us immediately upon becoming
            aware of any breach of security or unauthorised use of your account.
        </p>
        <h3>Termination</h3>
          <p>
            We may terminate or suspend access to our Service immediately, without prior notice or liability, for any
            reason whatsoever, including without limitation if you breach the Terms.
        </p>
        <h3> Our Service may contain links to third-party websites or services that are not owned or controlled
             by {{config('app.name')}}.
          </h3>
          <p>
            Our Service may contain links to third-party websites or services that are not owned or controlled
            by {{config('app.name')}}.
            {{config('app.name')}} has no control over and assumes no responsibility for, the content, privacy policies,
            or practices
            of any third party websites or services.
            You further acknowledge and agree that {{config('app.name')}} shall
            not be responsible
            or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection
            with the use of or reliance on any such content, goods or services available on or through any such websites
            or services.
        </p>
        <p>
            We strongly advise you to read the terms and conditions and privacy policies of any third-party websites or
            services that you visit.
        </p>
        <p>
            All provisions of the Terms which by their nature should survive termination shall survive termination,
            including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of
            liability.
        </p>
        <p>
            We may terminate or suspend your account immediately, without prior notice or liability, for any reason
            whatsoever, including without limitation if you breach the Terms.
        </p>
        <p>
            Upon termination, your right to use the Service will immediately cease. If you wish to terminate your
            account,you may simply discontinue using the Service.
        </p>
        <p>
            All provisions of the Terms which by their nature should survive termination shall survive termination,
            including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of
            liability.
        </p>
        <h3>Governing Law</h3>
          <p>
            These Terms shall be governed and construed in accordance with the laws of South Africa, without regard to
            its conflict of law provisions.
        </p>
        <p>
            Our failure to enforce any right or provision of these Terms will not be considered a waiver of those
            rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining
            provisions of
            these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our
            Service, and supersede and replace any prior agreements we might have between us regarding the Service.
        </p>
        <h3>Changes</h3>
          <p>
            We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is
            a material we will try to provide at least 15 days notice prior to any new terms taking effect. What
            constitutes a material change will be determined at our sole discretion.
        </p>
        <p>
            By continuing to access or use our Service after those revisions become effective, you agree to be bound by
            the revised terms. If you do not agree to the new terms, please stop using the Service.
        </p>

        <p>
            Please read these Terms and Conditions (“Terms”, “Terms and Conditions”) carefully before using the
          {{ config('app.url') }} website (the “Service”) operated by {{ config('app.name') }} (“us”, “we”, or “our”). <br>

            Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms.
            These Terms apply to all visitors, users and others who access or use the Service. <br>

            By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the
            terms then you may not access the Service.
        </p>
    </article>
</div>

</x-base-layout>
