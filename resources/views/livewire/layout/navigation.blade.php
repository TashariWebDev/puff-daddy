<?php

use Livewire\Volt\Component;

new class extends Component {
    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }"
     class="bg-black border-b border-teal-100"
>
    <!-- Primary Navigation Menu -->
    <div class="container py-2 px-4 mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('welcome') }}"
                       wire:navigate
                    >
                        <x-application-logo class="w-auto h-16 lg:h-20 drop-shadow"
                                            dark="true"
                        />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('dashboard')"
                                :active="request()->routeIs('dashboard')"
                                wire:navigate
                    >
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('orders')"
                                :active="request()->routeIs('orders')"
                                wire:navigate
                    >
                        {{ __('Orders') }}
                    </x-nav-link>

                    <x-nav-link :href="route('account')"
                                :active="request()->routeIs('account')"
                                wire:navigate
                    >
                        {{ __('Account') }}
                    </x-nav-link>

                    @if(!request()->user()->isWholesale())
                        <x-nav-link :href="route('wholesale-application')"
                                    :active="request()->routeIs('wholesale-application')"
                                    wire:navigate
                        >
                            Wholesale Application
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right"
                            width="48"
                >
                    <x-slot name="trigger">
                        <button class="inline-flex items-center py-2 px-3 text-sm font-medium leading-4 text-teal-400 bg-black rounded-md border border-transparent transition duration-150 ease-in-out hover:text-teal-400 focus:outline-none">
                            <div x-data="{ name: '{{ auth()->user()->name }}' }"
                                 x-text="name"
                                 x-on:profile-updated.window="name = $event.detail.name"
                            ></div>

                            <div class="ml-1">
                                <svg class="w-4 h-4 fill-current"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20"
                                >
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')"
                                         wire:navigate
                        >
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('update-password')"
                                         wire:navigate
                        >
                            {{ __('Update Password') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('delivery-address')"
                                         wire:navigate
                        >
                            {{ __('Delivery Address') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout"
                                class="w-full text-left"
                        >
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex justify-center items-center p-2 text-gray-400 rounded-md transition duration-150 ease-in-out hover:text-gray-500 hover:bg-gray-100 focus:text-gray-500 focus:bg-gray-100 focus:outline-none"
                >
                    <svg class="w-6 h-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24"
                    >
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"
                        />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}"
         class="hidden sm:hidden"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')"
                                   :active="request()->routeIs('dashboard')"
                                   wire:navigate
            >
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('orders')"
                                   :active="request()->routeIs('orders')"
                                   wire:navigate
            >
                {{ __('Orders') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('account')"
                                   :active="request()->routeIs('account')"
                                   wire:navigate
            >
                {{ __('Account') }}
            </x-responsive-nav-link>

            @if(!request()->user()->isWholesale())
                <x-responsive-nav-link :href="route('wholesale-application')"
                                       :active="request()->routeIs('wholesale-application')"
                                       wire:navigate
                >
                    {{ __('Wholesale Application') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-white"
                     x-data="{ name: '{{ auth()->user()->name }}' }"
                     x-text="name"
                     x-on:profile-updated.window="name = $event.detail.name"
                ></div>
                <div class="text-sm font-medium text-white">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')"
                                       wire:navigate
                >
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('update-password')"
                                       wire:navigate
                >
                    {{ __('Update Password') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('delivery-address')"
                                       wire:navigate
                >
                    {{ __('Delivery Address') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout"
                        class="w-full text-left"
                >
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
