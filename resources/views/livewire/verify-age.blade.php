<div>
    @if(!session()->has('verified'))
    <div
        class="fixed inset-0 z-50 h-screen bg-white opacity-95 backdrop-blur"
    >
            <div class="z-50 h-full bg-white/80 backdrop-blur">
                <div class="flex flex-col justify-center items-center h-full">
                    <div class="relative pb-10">
                       <x-application-logo class="w-64"/>
                    </div>
                    <p class="text-center text-white">our products are not available for sale to minors</p>
                    <p class="text-white">are you over the age of 18?</p>
                    
                    <div class="grid grid-cols-2 gap-4 py-4 px-2">
                        <button
                            wire:click.prevent="verify"
                            class="uppercase rounded-lg shadow  bg-[#5CC6CF] border border-transparent hover:opacity-90  hover:border-[#5CC6CF] text-white text-sm lg:text-base px-2 font-semibold"
                        >Yes
                        </button>
                        <a
                            href="https://www.gov.za/documents/tobacco-products-control-act"
                            target="_blank"
                            class="py-2 px-4 text-center text-pink-600 uppercase bg-white rounded-lg border border-pink-600 shadow hover:text-pink-800 hover:bg-pink-200"
                        >No</a>
                    </div>
                    
                  
                </div>
            </div>
        </div>
  @endif
</div>
