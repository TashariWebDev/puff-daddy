<?php

namespace App\Console\Commands;

use App\Mail\TestTailwindcssMail;
use Illuminate\Console\Command;
use Mail;

class TestEmailCommand extends Command
{
    protected $signature = 'test:email';

    protected $description = 'Command description';

    public function handle(): void
    {
        Mail::to(config('mail.from.address'))->later(1,
            new TestTailwindcssMail
        );
    }
}
