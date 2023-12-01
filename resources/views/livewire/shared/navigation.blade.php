<div class="z-40 py-1 w-full text-right bg-black lg:fixed">

    <div class="container flex justify-between items-center px-2 mx-auto">

        <div class="flex justify-center items-center space-x-4">
            <a
                href="{{ route('welcome') }}"
                wire:navigate
            >
                <x-application-logo
                    dark="true"
                    class="w-auto h-16 lg:h-20 drop-shadow"
                />
            </a>
        </div>

        <div class="flex space-x-4">
            @auth
                @if($order)
                    <a
                        href="{{ route('cart') }}"
                        class="font-semibold text-yellow-300 hover:text-yellow-400 focus:rounded-sm group focus:outline focus:outline-2 focus:outline-red-500"
                        wire:navigate
                    >
                        <div class="flex items-center space-x-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 group-hover:text-yellow-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
                                />
                            </svg>
                            <div class="leading-snug text-yellow-300 group-hover:text-yellow-400 text-[10px]">
                                <p>{{ $this->order->items->sum('qty') }} items</p>
                                <p class="whitespace-nowrap">
                                    R {{ number_format($this->order->getTotal(),2) }}</p>
                            </div>
                        </div>
                    </a>
                @endif



                <div class="sm:flex sm:items-center sm:ml-6">
                    <x-dropdown
                        align="right"
                        width="48"
                    >
                        <x-slot name="trigger">
                            <button class="inline-flex items-center py-2 px-3 text-sm font-medium leading-4 text-teal-400 bg-black rounded-md border border-transparent transition duration-150 ease-in-out hover:text-teal-600 focus:outline-none">
                                <div
                                    x-data="{ name: '{{ auth()->user()->name }}' }"
                                    x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"
                                ></div>

                                <div class="ml-1">
                                    <svg
                                        class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link
                                :href="route('dashboard')"
                                wire:navigate
                            >
                                {{ __('Dashboard') }}
                            </x-dropdown-link>

                            <x-dropdown-link
                                :href="route('profile')"
                                wire:navigate
                            >
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if( !auth()->user()->isWholesale() )
                                <x-dropdown-link
                                    :href="route('wholesale-application-form')"
                                    wire:navigate
                                >
                                    Wholesale
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <button
                                wire:click="logout"
                                class="w-full text-left"
                            >
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else

                <button
                    class="py-2 px-3 font-semibold text-white bg-gradient-to-b from-teal-400 to-teal-600 rounded hover:bg-teal-600 hover:from-teal-500 hover:to-teal-600 focus:rounded-sm focus:outline focus:outline-2 focus:outline-teal-500"
                    x-on:click="$dispatch('open-modal',{name: 'login-modal'})"
                >
                    Log in
                </button>

                <button
                    class="px-3 font-semibold text-white bg-gradient-to-b from-teal-400 to-teal-600 rounded hover:bg-teal-600 hover:from-teal-500 hover:to-teal-600 focus:rounded-sm y-2 focus:outline focus:outline-2 focus:outline-teal-500"
                    x-on:click="$dispatch('open-modal',{name: 'register-modal'})"
                >
                    Register
                </button>

            @endauth
        </div>
    </div>

    <x-modal
        title="Sign in to your account"
        name="login-modal"
    >
        <div class="p-2 w-full">
            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4"
                :status="session('status')"
            />

            <div class="p-6 w-full text-left bg-white rounded-lg">
                <form wire:submit="login">
                    <!-- Email Address -->
                    <div>
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                        />
                        <x-text-input
                            wire:model="email"
                            id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label
                            for="password"
                            :value="__('Password')"
                        />

                        <x-text-input
                            wire:model="password"
                            id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label
                            for="remember"
                            class="inline-flex items-center"
                        >
                            <input
                                wire:model="remember"
                                id="remember"
                                type="checkbox"
                                class="text-indigo-600 rounded border-gray-300 shadow-sm focus:ring-indigo-500"
                                name="remember"
                            >
                            <span class="ml-2 text-sm text-teal-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex justify-end items-center mt-4">
                        @if (Route::has('password.request'))
                            <a
                                class="text-sm text-teal-400 underline rounded-md hover:text-teal-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                                href="{{ route('password.request') }}"
                                wire:navigate
                            >
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button class="ml-3 button-green">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>

            </div>
            <div class="flex justify-end py-6">
                <a
                    wire:navigate
                    href="{{ route('register') }}"
                >No account? Register here</a>
            </div>
        </div>
    </x-modal>

    <x-modal
        title="Sign up a new account"
        name="register-modal"
    >
        <div class="p-2 w-full">
            <div class="p-6 w-full text-left bg-white rounded-lg">

                <form wire:submit="register">
                    <!-- Name -->
                    <div>
                        <x-input-label
                            for="name"
                            :value="__('Name')"
                        />
                        <x-text-input
                            wire:model="name"
                            id="name"
                            class="block mt-1 w-full"
                            type="text"
                            name="name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Phone -->
                    <div class="mt-4">
                        <x-input-label
                            for="phone"
                            :value="__('Phone')"
                        />
                        <x-text-input
                            wire:model="phone"
                            id="phone"
                            class="block mt-1 w-full"
                            type="text"
                            name="phone"
                            required
                            autocomplete="phone_number"
                        />
                        <x-input-error
                            :messages="$errors->get('phone')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                        />
                        <x-text-input
                            wire:model="email"
                            id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            required
                            autocomplete="username"
                        />
                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label
                            for="password"
                            :value="__('Password')"
                        />

                        <x-text-input
                            wire:model="password"
                            id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label
                            for="password_confirmation"
                            :value="__('Confirm Password')"
                        />

                        <x-text-input
                            wire:model="password_confirmation"
                            id="password_confirmation"
                            class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        />

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex justify-end items-center mt-4">
                        <a
                            class="text-sm text-teal-400 underline rounded-md hover:text-teal-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                            href="{{ route('login') }}"
                            wire:navigate
                        >
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-4 button-green">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>


</div>
