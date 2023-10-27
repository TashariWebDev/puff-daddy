<div>
  <div class="py-4 bg-gray-900"
  >
    <h2 class="sr-only">Our perks</h2>
    <div
        class="mx-auto max-w-7xl bg-white divide-y divide-gray-200 shadow-2xl lg:flex lg:justify-center lg:py-8 lg:rounded-2xl lg:divide-y-0 lg:divide-x"
    >
      <div class="py-8 lg:flex-none lg:py-0 lg:w-1/3">
        <div class="flex items-center px-4 mx-auto max-w-xs lg:px-8 lg:max-w-none">
          <svg
              class="flex-shrink-0 w-8 h-8 text-gray-600"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
          >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
            />
          </svg>
          <div class="flex flex-col-reverse flex-auto ml-4">
            <h3 class="font-medium text-gray-900">Customer support</h3>
            <a
                class="text-sm text-gray-500 underline hover:text-green-400 underline-offset-2"
                href="mailto:sales@vapecrew.capetown"
            >
              email us any queries
            </a>
          </div>
        </div>
      </div>
      <div class="py-8 bg-white lg:flex-none lg:py-0 lg:w-1/3">
        <div class="flex items-center px-4 mx-auto max-w-xs lg:px-8 lg:max-w-none">
          <div class="relative">
            <x-icons.whatsapp class="flex-shrink-0 w-8 h-8 text-gray-600"/>
            <div
                class="absolute top-0 right-0 w-2 h-2 bg-green-600 rounded-full ring-1 ring-green-300 animate-pulse"
            >
            </div>
          </div>
          <div class="flex flex-col-reverse flex-auto ml-4">
            <h3 class="font-medium text-gray-900">Chat on whatsapp</h3>
            <button
                class="text-sm text-left text-gray-500 underline hover:text-green-400 underline-offset-2"
                x-data
                x-on:click="$dispatch('open-modal',{name: 'chat-modal'})"
            >
              click here to start a chat
            </button>
          </div>
        </div>
      </div>
      <div class="py-8 bg-white lg:flex-none lg:py-0 lg:w-1/3">
        <div class="flex items-center px-4 mx-auto max-w-xs lg:px-8 lg:max-w-none">
          <svg
              class="flex-shrink-0 w-8 h-8 text-gray-600"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
          >
            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"
            />
          </svg>
          <div class="flex flex-col-reverse flex-auto ml-4">
            <h3 class="font-medium text-gray-900">Fast, reliable shipping</h3>
            <p class="text-sm text-gray-500">Products shipped the next day</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <x-modal
      title="Select a number to chat with:"
      name="chat-modal"
  >
    <div class="flex-col space-y-4">
      <div class="py-12 mt-6 bg-white lg:flex-none lg:py-0 lg:w-1/3">
        <div class="flex items-center mx-auto space-x-4">
          <div class="relative">
            <x-icons.whatsapp class="w-6 h-6 text-gray-600"/>
            <div
                class="absolute top-0 right-0 w-2 h-2 bg-green-600 rounded-full ring-1 ring-green-300 animate-pulse"
            >
            </div>
          </div>
          <div class="whitespace-nowrap">
            <h3 class="font-medium text-gray-900">Chat on whatsapp</h3>
          </div>
        </div>
      </div>
      <div>
        <a
            class="block py-2 px-2 w-full text-xs font-semibold uppercase bg-green-200 rounded-md shadow hover:bg-green-300"
            href="https://wa.me/+27827010335"
        >
              <span class="w-full">
                  Chat with Faeeza (Admin & Accounts)
              </span>
        </a>
      </div>
      <div>
        <a
            class="block py-2 px-2 w-full text-xs font-semibold uppercase bg-green-200 rounded-md shadow hover:bg-green-300"
            href="https://wa.me/+27836459599"
        >
              <span class="w-full">
                  Chat with Ridwaan (Wholesale)
              </span>
        </a>
      </div>
    </div>
  </x-modal>
</div>
