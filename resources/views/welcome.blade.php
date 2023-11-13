<x-base-layout
    title="{{ config('app.name') }} - South Africa's Premium Vape Distro"
    description="Vape Crew is one of the leading direct importers and distributors of vape related products in South Africa"
    keywords="Vape Distro, Nasty, OKK Cross, Uwell"
>

    <x-header-banners />

    <div class="z-40 py-4 w-full bg-black">
        <x-scrolling-notifications />
    </div>

    <x-pages.welcome.perks />

    <livewire:pages.welcome.featured-products />

    <livewire:pages.welcome.product-grid />


</x-base-layout>
