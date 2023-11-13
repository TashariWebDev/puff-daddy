@props(['title','name'])

<div
    x-data="{ show : false, name: @js($name) }"
    x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)"
    x-on:close-modal.window="show = false"
    x-on:wire:keydown.escape.window="show = false"
    x-transition
    x-cloak
    class="overscroll-contain fixed inset-0 z-[9999]"
>
  
  {{--Background Overlay--}}
  <div class="fixed inset-0 bg-transparent backdrop-blur z-[9999]"></div>
  
  <div
      x-on:click="$dispatch('close-modal')"
      class="fixed inset-0 bg-gradient-to-br from-blue-400 to-blue-400 opacity-60 via-slate-800"
  ></div>
  
  {{--body--}}
  <div class="overflow-y-scroll fixed inset-0 p-2 m-auto w-full max-w-4xl bg-white rounded-xl shadow-xl lg:p-6 z-[9999] h-fit max-h-[600px]">
    <div class="flex justify-between items-center">
      <div>
        <p>{{ $title ?? '' }}</p>
      </div>
      <div>
        <button
            x-on:click="$dispatch('close-modal')"
            class="font-bold text-pink-600"
        >
          <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 text-pink-600 hover:text-pink-400"
          >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </button>
      </div>
    </div>
    <div class="text-left">
      {{ $slot }}
    </div>
  </div>
</div>
