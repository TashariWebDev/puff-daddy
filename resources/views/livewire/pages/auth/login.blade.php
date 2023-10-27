<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    #[Rule(['required', 'string'])]
    public string $password = '';

    #[Rule(['boolean'])]
    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!auth()->attempt($this->only(['email', 'password'], $this->remember))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        session()->regenerate();

        $this->redirect(
            session('url.intended', '/'),
            navigate: true
        );
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="p-2 w-full lg:w-2/3">
  <!-- Session Status -->
  <x-auth-session-status
      class="mb-4"
      :status="session('status')"
  />
  
  <div class="p-6 w-full bg-white rounded-lg shadow">
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
          <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
      </div>
      
      <div class="flex justify-end items-center mt-4">
        @if (Route::has('password.request'))
          <a
              class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
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
