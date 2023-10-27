<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta
      name="viewport"
      content="width=device-width, initial-scale=1"
  >
  <meta
      name="csrf-token"
      content="{{ csrf_token() }}"
  >
  
  <link
      rel="preconnect"
      href="https://fonts.googleapis.com"
  >
  <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin
  >
  <link
      href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;600;700;900&family=Poppins&display=swap"
      rel="stylesheet"
  >
  
  <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  
  <meta
      name="description"
      content="{{ $description ?? '' }}"
  />
  
  <meta
      name="Keywords"
      content="{{ $keywords ?? '' }}"
  >
  
  <x-favicon/>
  
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="overflow-y-auto relative font-sans antialiased text-gray-900 bg-gray-50"
    id="body"
    x-data
    x-on:open-modal.window="document.getElementById('body').classList.add('overflow-hidden')"
    x-on:close-modal.window="document.getElementById('body').classList.remove('overflow-hidden')"
>
  
  <livewire:shared.product-filter/>
  
  <x-flash-notification/>
  
  <livewire:shared.navigation/>
  
  <div class="lg:pt-24">
    {{ $slot }}
  </div>

</body>
</html>
