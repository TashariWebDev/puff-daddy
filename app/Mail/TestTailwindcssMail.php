<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestTailwindcssMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function build(): self
    {

        return $this->view('emails.test')
            ->subject('test email');
    }
}
