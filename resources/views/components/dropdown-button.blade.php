<button class="py-4 px-2 w-full text-left bg-white rounded border shadow hover:bg-gray-100"
    {{ $attributes }}
>
  <div class="flex justify-between items-center">
    <div class="flex items-center space-x-1 font-semibold uppercase lg:space-x-3 lg:text-base text-[10px]">
      {{ $slot }}
    </div>
    <div>
      <svg xmlns="http://www.w3.org/2000/svg"
           fill="none"
           viewBox="0 0 24 24"
           stroke-width="1.5"
           stroke="currentColor"
           class="w-6 h-6"
      >
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M19.5 8.25l-7.5 7.5-7.5-7.5"
        />
      </svg>
    </div>
  </div>
</button>
