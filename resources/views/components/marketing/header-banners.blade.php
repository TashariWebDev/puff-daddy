<div class="overflow-hidden relative p-2 bg-gradient-to-tr lg:p-10 from-slate-900 to-slate-950">
  
  
  <div class="py-2 text-center lg:hidden">
    <h1 class="text-lg font-semibold">{{ config('app.name') }}</h1>
  </div>
  
  @if (!empty($banners))
    <div x-data="{ banners: @js($banners), index: 0 }"
         x-cloak
         x-init="setInterval(() => {
                    if (index === banners.length - 1) {
                        index = 0
                    } else {
                        index++;
                    }
                }, 3000);"
         class="z-40 aspect-[3/1]"
    >
      
      <img
          class="object-fill z-40 w-full h-full rounded-2xl shadow-2xl overflow-clip aspect-[3/1]"
          src=""
          alt=""
          x-transition
          x-bind:src="@js(config('app.admin_url')) + '/storage/' + banners[index]"
      >
    
    </div>
  @endif
</div>
