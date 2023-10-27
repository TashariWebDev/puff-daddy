<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public function sendVerification(): void
    {
        if (auth()->user()->hasVerifiedEmail()) {
            $this->redirect(
                session('url.intended', RouteServiceProvider::HOME),
                navigate: true
            );

            return;
        }

        auth()->user()->sendEmailVerificationNotification();

        session()->flash('status', 'verification-link-sent');
    }

    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="p-2 w-full lg:w-2/3">
  <div class="mb-4 text-sm text-gray-600">
    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
  </div>
  
  @if (session('status') == 'verification-link-sent')
    <div class="mb-4 text-sm font-medium text-green-600">
      {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
  @endif
  
  <div class="p-6 w-full bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mt-4">
      <x-button
          class="button-green"
          wire:click="sendVerification"
      >
        {{ __('Resend Verification Email') }}
      </x-button>
      
      <button
          wire:click="logout"
          type="submit"
          class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
      >
        {{ __('Log Out') }}
      </button>
    </div>
  </div>
</div>
