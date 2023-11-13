<div
    class="container mx-auto text-white bg-black lg:rounded-2xl"
    x-cloak
>
    @if ($notifications)
        @php
            $colours = ['text-pink-200','text-purple-200','text-orange-200','text-sky-200','text-yellow-100']
        @endphp
        <div
            class="flex overflow-hidden relative py-6 space-x-12 w-full h-auto"
        >
            <div class="flex items-center space-x-12 lg:rounded-b-xl animate-ticker">
                @for($i = 0; $i < 10; $i++)
                    @foreach ($notifications as $notification)
                        <h2
                            class="text-lg font-bold text-[#5CC6CF] uppercase whitespace-nowrap"
                        >
                            {{ $notification}}</h2>
                    @endforeach
                @endfor
            </div>
        </div>
    @endif
</div>
