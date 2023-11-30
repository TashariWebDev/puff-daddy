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

    @if(app()->isProduction())
        <!-- Google Tag Manager -->
        <script>(function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start":
                        new Date().getTime(), event: "gtm.js"
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src =
                    "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "GTM-WZ82566B");</script>
        <!-- End Google Tag Manager -->
    @endif

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

    <x-favicon />

        <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net"
    >
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet"
    />

        <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900">


    @if(app()->isProduction())
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ82566B"
                    height="0"
                    width="0"
                    style="display:none;visibility:hidden"
            ></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif


    <div class="flex flex-col items-center pt-6 min-h-screen bg-gray-50 sm:justify-center sm:pt-0">
        <div>
            <a href="/"
               wire:navigate
            >
                <x-application-logo class="w-auto h-20" />
            </a>
        </div>

        <div class="overflow-hidden py-4 px-6 mt-6 w-full bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
