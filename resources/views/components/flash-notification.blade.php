<div
    x-data="{ body:'' }"
    x-cloak
    x-on:notification.window="body = $event.detail.body; setTimeout(() => body = '',2000)"
    x-init="
        @if( session()->has('notification'))
            window.onload = () => {
                window.dispatchEvent(new CustomEvent('notification',{
                    detail: {body:'{{ session('notification') }}'}
                }))
            }
        @endif
    "
>
  
  <div x-show="body"
       x-transition:enter="transform ease-in-out duration-75 transition"
       x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
       x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       aria-live="assertive"
       class="flex fixed inset-0 z-50 items-end py-6 px-4 pointer-events-none sm:items-start sm:p-6"
  >
    <div class="flex flex-col items-center space-y-4 w-full sm:items-end">
      <div
          class="overflow-hidden w-full max-w-sm bg-white bg-opacity-75 rounded-lg ring-1 ring-yellow-400 ring-opacity-5 shadow-lg pointer-events-auto"
      >
        <div class="p-4">
          <div class="flex items-start">
            <div class="flex-shrink-0">
              <svg class="w-6 h-6 text-green-700"
                   xmlns="http://www.w3.org/2000/svg"
                   fill="none"
                   viewBox="0 0 24 24"
                   stroke-width="2"
                   stroke="currentColor"
                   aria-hidden="true"
              >
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </div>
            <div class="flex-1 pt-0.5 ml-3 w-0">
              <p class="text-sm font-medium text-gray-800 opacity-100"
                 x-text="body"
              ></p>
            </div>
            <div class="flex flex-shrink-0 ml-4">
              <button type="button"
                      class="inline-flex text-gray-800 rounded-md hover:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                      x-on:click="body = ''"
              >
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20"
                     fill="currentColor"
                     aria-hidden="true"
                >
                  <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
