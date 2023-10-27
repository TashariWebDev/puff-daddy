<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1"
  >
  <meta name="csrf-token"
        content="{{ csrf_token() }}"
  >
  
  <link rel="preconnect"
        href="https://fonts.googleapis.com"
  >
  <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
  >
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;600;700;900&family=Poppins&display=swap"
        rel="stylesheet"
  >
  
  <title>{{ config('app.name', 'Laravel') }}</title>
  
  <x-favicon/>
  
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
  
  <div class="grid grid-cols-1 max-h-screen lg:grid-cols-2">
    <div class="hidden justify-center items-center h-screen lg:flex">
      <a href="/"
         wire:navigate
      >
        <x-application-logo class="w-auto h-full"/>
      </a>
    </div>
    <div class="flex-col justify-center items-center min-h-screen bg-gray-100 lg:flex">
      <a href="/"
         wire:navigate
      >
        <x-application-logo class="block py-6 m-auto w-20 h-auto lg:hidden"/>
      </a>
      {{ $slot }}
    </div>
  </div>
</body>
</html>
