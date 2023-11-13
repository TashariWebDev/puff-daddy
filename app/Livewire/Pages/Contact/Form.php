<?php

namespace App\Livewire\Pages\Contact;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Form extends Component
{
    public $name;

    public $email;

    public $phone;

    public $company;

    public $message;

    public function sendMessage()
    {
        //Create Email
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.contact.form');
    }
}
