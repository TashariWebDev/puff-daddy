@props([
    'dark' => false
])

@if($dark)
    <img
        src="{{ asset('assets/logo_dark.png') }}"
        alt="{{ config('app.name') }}"
        {{ $attributes->merge(['class' => 'drop-shadow-sm hidden lg:block py-2']) }}
    >

    <img
        src="{{ asset('assets/small_dark.png') }}"
        alt="{{ config('app.name') }}"
        {{ $attributes->merge(['class' => 'drop-shadow-sm block lg:hidden p-2']) }}
    >
@else
    <img
        src="{{ asset('assets/full-logo.png') }}"
        alt="{{ config('app.name') }}"
        {{ $attributes->merge(['class' => 'drop-shadow-sm hidden lg:block py-2']) }}
    >

    <img
        src="{{ asset('assets/small-logo.png') }}"
        alt="{{ config('app.name') }}"
        {{ $attributes->merge(['class' => 'drop-shadow-sm block lg:hidden p-2']) }}
    >
@endif
