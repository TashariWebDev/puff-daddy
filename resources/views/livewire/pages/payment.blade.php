<div classs="relative">
  
  
  
  @if($amount > 0)
    <div>
        <div class="grid grid-cols-1 w-screen lg:grid-cols-2 lg:min-h-screen">
            <div class="hidden items-center h-full bg-gray-200 lg:flex lg:justify-center">
                <div>
                    <h1 class="text-5xl font-bold underline underline-offset-8">Payment</h1>
                    <div class="py-4">
                        <p class="text-lg">Just one more step to complete your order.</p>
                    </div>
                    <div class="py-4">
                        <p class="text-lg">Simply select one of the available payment options to proceed.</p>
                        <p class="text-sm text-gray-500">
                            * you will be redirected to the respective payment gateway to complete your payment of
                            R {{ number_format($amount,2) }}
                        </p>
                    </div>
                    <div class="flex items-end pt-32 space-x-4">
                        <a
                            href="{{ route('welcome') }}"
                            class="button-success"
                        >
                            Place another order
                        </a>

                        <a
                            href="{{ route('orders') }}"
                            class="button-success"
                        >
                            View your orders
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex justify-center items-start w-full h-full lg:items-center">
                    <div class="py-10 px-4 w-full">
                        <div class="px-2 text-center lg:hidden">
                            <h1 class="text-3xl font-bold">Payment</h1>
                            <div class="py-4 text-lg">
                                <p>Just one more step to place your order.</p>
                            </div>
                            <div class="py-2 lg:py-4">
                                <p class="text-lg font-bold underline lg:text-sm underline-offset-4">Choose payment option below.</p>
                                <p class="hidden text-sm text-gray-500 lg:block">
                                    * you will be redirected to the respective payment gateway to complete your payment
                                    of
                                    R {{ number_format($amount,2) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-8 w-full">
                            <div class="w-full lg:pb-4">
                                <div class="py-2 border-b-2">
                                    <p class="hidden text-sm font-semibold lg:block">
                                        Payment using your debit or credit card.
                                    </p>
                                    <p class="text-sm font-semibold lg:hidden">Pay in full or 4 equal payments of <span>R {{ number_format($amount/4,2) }}</span> </p>
                                  {{--                                    <div class="hidden lg:block">--}}
                                  {{--                                        <livewire:payflex-widget :amount="$amount"/>--}}
                                  {{--                                    </div>--}}
                                </div>
                                <div class="flex py-2">
                                    <button
                                        class="p-2 w-48 bg-gray-100 rounded-md border-2 border-purple-400 shadow hover:bg-gray-200 hover:ring hover:ring-offset-2 disabled:opacity-25"
                                        wire:click="attemptPaymentWithPayflex"
                                    >
                                        <img
                                            src="{{ config('app.admin_url').'/images/payflex.svg' }}"
                                            alt="Payflex"
                                            class="object-cover"
                                        >
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full lg:pb-4"
                                x-data="{show:false}"
                            >
                                <div class="py-2 border-b-2">
                                    <p class="pb-2 text-sm font-semibold">
                                        Ozow is one of the easiest, quickest, and safest ways to make  <span class="font-bold">EFT</span> payments.
                                    </p>
                                    <button
                                        class="text-green-600 underline disabled:opacity-25 underline-offset-2"
                                        x-on:click="show = !show"
                                    >learn more</button>

                                    <div
                                        class="space-y-3"
                                        x-show="show"
                                        x-transition
                                    >
                                        <p class="text-sm">
                                            Ozow is licensed by the Payments Association of South Africa as a Systems Operator and Third-Party Payments Provider, abide by PCI-DSS Level 1 processes, and they are PCI-certified, even though they don’t process credit cards.
                                        </p>
                                        <p class="text-sm">
                                            We also make sure all payment and banking information is encrypted end-to-end, and we don’t save of it unless you give us permission to.
                                        </p>
                                        <p class="text-sm">
                                            Every payment also needs to be authorised with two-factor authentication, otherwise it won’t be honoured. And to top it off, we also adhere to POPIA and GDPR regulations.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex py-2">
                                    <form
                                        action="{{config('services.ozow.liveUrl')}}"
                                        method="POST"
                                    >
                                        @csrf
                                      @foreach ($ozowPostData as $key => $value)
                                        <input
                                            type="hidden"
                                            name="{{$key}}"
                                            value="{{$value}}"
                                        >
                                      @endforeach
                                      <button
                                          type="submit"
                                          class="p-2 w-48 bg-gray-100 rounded-md border-2 border-green-400 shadow hover:bg-gray-200 hover:ring hover:ring-offset-2 disabled:opacity-25"
                                      >
                                        <img
                                            src="{{ config('app.admin_url').'/images/ozow.svg' }}"
                                            alt="Ozow"
                                            class="object-cover"
                                        >
                                    </button>
                                    </form>
                                </div>
                            </div>
                          
                          @if(auth()->user()->is_wholesale)
                            <div class="pb-4 w-full">
                                <div class="py-2 border-b-2">
                                    <p class="pb-2 text-sm font-semibold">
                                        Offline payment.
                                    </p>
                                </div>
                                <div class="flex py-2">
                                    <button
                                        class="flex items-center p-2 w-48 font-bold bg-gray-100 rounded-md border-2 border-green-400 shadow hover:bg-gray-200 hover:ring hover:ring-offset-2 disabled:opacity-25"
                                        wire:click="payLater"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="mr-2 w-10 h-auto"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
                                            />
                                        </svg>
                                        EFT or Cash
                                    </button>
                                </div>
                            </div>
                          @endif
                          
                          
                          <div class="hidden">
                            <form
                                action="{{config('services.ozow.liveUrl')}}"
                                method="POST"
                                class="hidden"
                                x-ref="ozow"
                            >
                                @csrf
                              @foreach ($ozowPostData as $key => $value)
                                <input
                                    type="hidden"
                                    name="{{$key}}"
                                    value="{{$value}}"
                                >
                              @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      @else
        <div class="flex justify-center items-center h-screen bg-white rounded-md">
            <div class="items-center">
                <div class="flex justify-center text-center">
                    <x-icons.shopping-bag class="w-32 h-32 text-gray-900"/>
                </div>
                <div>
                    <p class="text-sm font-medium text-center">Nothing in the cart!</p>
                    <a
                        href="{{route('welcome')}}"
                        class="text-sm font-semibold text-center underline hover:text-yellow-800 underline-offset-2"
                    >
                        &larr; Lets start shopping
                    </a>
                </div>
            </div>
        </div>
      @endif
</div>
</div>
