<div>

    <div class="w-screen">
        <img src="{{ config('app.admin_url').'/storage/'.$page->header_image }}"
             alt=""
        >
    </div>

    <div class="py-10 px-2 max-w-none lg:px-20 prose prose-teal">
        <h1 class="text-6xl font-extrabold">{{ $page->title }}</h1>

        <div>
            <p class="lg:text-xl">
                {!! nl2br($page->description) !!}
            </p>
        </div>
    </div>

    @if($page->verification_url)
        <div class="py-10 px-2 max-w-none lg:px-20 prose prose-teal">
            <div class="p-2 text-center bg-white rounded-lg border">
                <a href="{{  $page->verification_url }}"
                   target="__blank"
                   class="pb-1 text-lg font-semibold text-teal-400 no-underline border-b border-teal-400 hover:text-teal-500"
                >
                    Verify the authenticity of your products at {{  $page->verification_url }}
                </a>
            </div>
        </div>
    @endif

    @if($products)
        <div class="overflow-hidden py-6 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-x-2 gap-y-4 -mx-px sm:mx-0 md:grid-cols-4 lg:grid-cols-6 lg:gap-4 lg:gap-y-6">
                @foreach($products as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>
        </div>
    @endif

    <div class="w-screen">
        <img src="{{ config('app.admin_url').'/storage/'.$page->footer_image }}"
             alt=""
        >
    </div>

</div>
