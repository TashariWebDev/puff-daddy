<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate();

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="p-2 w-full lg:w-2/3">
  <div class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
  </div>
  
  <!-- Session Status -->
  <x-auth-session-status
      class="mb-4"
      :status="session('status')"
  />
  
  <div class="p-6 w-full bg-white rounded-lg shadow">
    <form wire:submit="sendPasswordResetLink">
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
        />
        <x-input-error
            :messages="$errors->get('email')"
            class="mt-2"
        />
      </div>
      
      <div class="flex justify-end items-center mt-4">
        <x-button class="button-green">
          {{ __('Email Password Reset Link') }}
        </x-button>
      </div>
    </form>
  </div>
</div>
