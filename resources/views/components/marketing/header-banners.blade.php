<div class="overflow-hidden relative p-2 bg-black lg:p-10">
    
    
    @if (!empty($banners))
        <div
            x-data="{ banners: @js($banners), index: 0 }"
            x-cloak
            x-init="setInterval(() => {
                    if (index === banners.length - 1) {
                        index = 0
                    } else {
                        index++;
                    }
                }, 3000);"
            class="mx-auto"
        >
            <img
                class="object-cover object-center z-40 rounded-2xl overflow-clip lg:max-h-[533px] lg:max-w-[1600px]"
                src=""
                alt=""
                x-transition
                x-cloak
                x-bind:src="@js(config('app.admin_url')) + '/storage/' + banners[index]"
            >
        
        </div>
    @endif
</div>
