<button {{ $attributes->merge(['class' => 'py-2 px-1 group rounded disabled:opacity-25 disabled:animated-pulse']) }}>
  {{ $slot }}
</button>
