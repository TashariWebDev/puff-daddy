<?php

namespace App\Livewire\Pages\Contact;

use App\Livewire\Traits\WithNotifications;
use App\Mail\OnlineEnquiryMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mail;

class Form extends Component
{
    use WithNotifications;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $email;

    #[Rule('required')]
    public $phone;

    #[Rule('sometimes')]
    public $company;

    #[Rule('required')]
    public $message;

    public function sendMessage(): void
    {
        $validated = $this->validate();

        Mail::to(config('mail.from.address'))->later(1,
            new OnlineEnquiryMail($validated)
        );

        $this->reset([
            'name', 'email', 'phone', 'company', 'message',
        ]);

        $this->notify('message sent');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.contact.form');
    }
}
