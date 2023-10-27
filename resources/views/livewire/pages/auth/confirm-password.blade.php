<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    #[Rule(['required', 'string'])]
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate();

        if (!auth()->guard('web')->validate([
            'email' => auth()->user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}; ?>

<div class="p-2 w-full lg:w-2/3">
  <div class="mb-4 text-sm text-gray-600">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
  </div>
  
  <div class="p-6 w-full bg-white rounded-lg shadow">
    <form wire:submit="confirmPassword">
      <!-- Password -->
      <div>
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
      
      <div class="flex justify-end mt-4">
        <x-button class="button-green">
          {{ __('Confirm') }}
        </x-button>
      </div>
    </form>
  </div>
</div>
