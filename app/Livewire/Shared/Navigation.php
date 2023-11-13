<?php

namespace App\Livewire\Shared;

use App\Livewire\Traits\WithNotifications;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use RateLimiter;

class Navigation extends Component
{
    use WithNotifications;

    public Order $order;

    public string $name = '';

    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    public string $phone = '';

    #[Rule(['required', 'string'])]
    public string $password = '';

    public string $password_confirmation = '';

    #[Rule(['boolean'])]
    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! auth()->attempt($this->only(['email', 'password'], $this->remember))) {
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
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Customer::class],
            'phone' => ['required', 'string', 'unique:customers,phone'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['alt_phone'] = $validated['phone'];

        event(new Registered($customer = Customer::create($validated)));

        auth()->login($customer);

        $this->redirect('/', navigate: true);
    }

    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }

    public function mount(Order $order): void
    {
        if (auth()->check()) {
            $this->order = $order->inProgress();
        }
    }

    #[On('update-order')]
    public function updateOrder(Order $order): void
    {
        if (auth()->check()) {
            $this->order = $order->inProgress();
        }
    }

    #[On('add-to-cart')]
    public function addToCart(Product $product, $qty = 1)
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }

        $item = $this->order->addItem($product, $qty);

        if ($item->wasChanged('qty')) {
            $this->notify('item added to cart');
        } else {
            $this->notify('Max qty already in cart');
        }

        $this->dispatch('close-modal', 'name:add-to-cart-modal');

        $this->dispatch('update-order');
        $this->dispatch('update-cart');

    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {

        return view('livewire.shared.navigation');
    }
}
