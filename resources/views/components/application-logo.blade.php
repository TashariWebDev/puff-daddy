<img
    src="{{ asset('assets/full-logo.png') }}"
    alt="{{ config('app.name') }}"
    {{ $attributes->merge(['class' => 'drop-shadow-sm hidden lg:block py-2']) }}
>

<img
    src="{{ asset('assets/logo.png') }}"
    alt="{{ config('app.name') }}"
    {{ $attributes->merge(['class' => 'drop-shadow-sm block lg:hidden p-2']) }}
>
