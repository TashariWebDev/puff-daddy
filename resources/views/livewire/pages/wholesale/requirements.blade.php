<div class="lg:p-6">
  
  <h2 class="text-2xl font-semibold">Hi {{ ucwords(auth()->user()->name) }}</h2>
  
  <p class="text-sm lg:text-base">
    Thank you for your interest in joining our wholesale program.
  </p>
  
  <p class="text-sm lg:text-base">By joining you will receive a host of benefits:</p>
  
  <div class="px-1 pb-6 mx-auto mt-10 max-w-7xl border-b sm:mt-20 md:mt-24 lg:px-6">
    <dl
        class="grid grid-cols-1 gap-x-6 gap-y-10 mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16 lg:mx-0 lg:max-w-none"
    >
      
      <div class="relative pl-9">
        <dt class="inline text-sm font-semibold text-gray-900 lg:text-base">
          <x-icons.tick class="absolute top-1 left-1 w-5 h-5 text-green-600"/>
          Dedicated Customer Service.
        </dt>
        <dd class="inline text-sm lg:text-base">
          We are obsessed with offering the best customer experience.
        </dd>
      </div>
      
      <div class="relative pl-9">
        <dt class="inline text-sm font-semibold text-gray-900 lg:text-base">
          <x-icons.tick class="absolute top-1 left-1 w-5 h-5 text-green-600"/>
          Competitive Pricing.
        </dt>
        <dd class="inline text-sm lg:text-base">We are a direct importer and distributor.</dd>
      </div>
      
      <div class="relative pl-9">
        <dt class="inline text-sm font-semibold text-gray-900 lg:text-base">
          <x-icons.tick class="absolute top-1 left-1 w-5 h-5 text-green-600"/>
          Exclusive deals and products.
        </dt>
        <dd class="inline text-sm lg:text-base">
          We are constantly sourcing the latest products at the best deals.
        </dd>
      </div>
    
    </dl>
  </div>
  
  <div class="p-3 mt-6 text-sm bg-white rounded-lg shadow lg:text-base prose-sm lg:prose">
    <h4 class="font-semibold">
      In the interest of fair trade. We do have some basic requirements for the application
    </h4>
    <div class="py-3">
      <h5>Kindly confirm the following - </h5>
    </div>
    <ul>
      <li class="list-none">
        <label for="requirements">
          <input
              type="checkbox"
              value="STORE"
              wire:model.;ive="requirements"
          >
          <span class="pl-3">You own or operate a physical business or an active online store.</span>
        </label>
      </li>
      
      <li class="list-none">
        <label for="requirements">
          <input
              type="checkbox"
              value="CIPC"
              wire:model.live="requirements"
          >
          <span class="pl-3">
            Your business is registered with CIPC and you have the documents on hand.
          </span>
        </label>
      </li>
      
      <li class="list-none">
        <label for="requirements">
          <input
              type="checkbox"
              value="ID"
              wire:model.live="requirements"
          >
          <span class="pl-3">
            You have the business director's Identity document on hand.
          </span>
        </label>
      </li>
      
      <li class="list-none">
        <label for="requirements">
          <input
              type="checkbox"
              value="PHOTOS"
              wire:model.live="requirements"
          >
          <span class="pl-3">You have proof of your physical location in the form of photos</span>
        </label>
      </li>
      
      @if ( count($requirements) === 4)
        <li class="list-none">
          <div class="mt-6">
            <a
                class="py-2 px-1 w-1/5 text-white bg-green-600 rounded border border-transparent hover:bg-green-400"
                href="{{ route('wholesale-application-form') }}"
            >
              Continue to application form
            </a>
          </div>
        </li>
      @endif
    </ul>
  </div>
</div>
