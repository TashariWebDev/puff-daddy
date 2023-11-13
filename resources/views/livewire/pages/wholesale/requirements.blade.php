<div class="bg-white rounded-lg shadow lg:p-6">
  
  <h2 class="text-2xl font-semibold">Hi {{ ucwords(auth()->user()->name) }}</h2>
  
  <p class="text-sm lg:text-base">
    Thank you for your interest in joining our wholesale program.
  </p>
  
  <p class="text-sm lg:text-base">By joining you will receive a host of benefits:</p>
  
  <div class="py-6 px-1 mx-auto max-w-7xl border-b">
    <dl
        class="grid grid-cols-1 gap-x-6 mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:grid-cols-2 lg:grid-cols-1 lg:gap-x-8 lg:mx-0 lg:max-w-none"
    >
      
      <div class="relative pl-9">
        <dt class="inline text-sm font-semibold text-gray-900 lg:text-base">
          <x-icons.tick class="absolute top-1 left-1 w-5 h-5 text-teal-400"/>
          Dedicated Customer Service.
        </dt>
      </div>
      
      <div class="relative pl-9">
        <dt class="inline text-sm font-semibold text-gray-900 lg:text-base">
          <x-icons.tick class="absolute top-1 left-1 w-5 h-5 text-teal-400"/>
          Competitive Pricing.
        </dt>
      </div>
      
      <div class="relative pl-9">
        <dt class="inline text-sm font-semibold text-gray-900 lg:text-base">
          <x-icons.tick class="absolute top-1 left-1 w-5 h-5 text-teal-400"/>
          Exclusive deals and products.
        </dt>
      </div>
    
    </dl>
  </div>
  
  <div class="p-3 mt-6 text-sm lg:text-base prose-sm prose-teal lg:prose">
    <h4 class="font-semibold">
      In the interest of fair trade. We do have some basic requirements for the application
    </h4>
    <ul>
      <li>
        <p>You own or operate a physical business or an active online store.</p>
      </li>
      <li>
        <p>Your business is registered with CIPC and you have the documents on hand.</p>
      </li>
      <li>
        <p>You have the business director's Identity document on hand.</p>
      </li>
       <li>
        <p>You have proof of your physical location in the form of photos</p>
       </li>
      <li class="list-none">
          <div class="mt-10">
            <a
                class="py-2 px-4 text-teal-500 no-underline hover:text-teal-400 underline-offset-4"
                href="{{ route('wholesale-application-form') }}"
            >
              <p>
                &rarr; Continue to application form
              </p>
            </a>
          </div>
        </li>
    </ul>
    
  </div>
</div>
