<x-base-layout
    title="{{ config('app.name') }} - Unleash the power of vaping"
    description="Puff Daddy is an importer and distributor of vaping products"
    keywords="Vape Distro, Nasty,Oxbar"
>

    <x-header-banners />

    <div class="z-40 py-4 w-full bg-black">
        <x-scrolling-notifications />
    </div>

    <x-pages.welcome.perks />

    <livewire:pages.welcome.featured-products />

    <livewire:pages.welcome.product-grid />


</x-base-layout>
