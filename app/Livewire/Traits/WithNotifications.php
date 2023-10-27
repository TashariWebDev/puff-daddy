<?php

namespace App\Livewire\Traits;

trait WithNotifications
{
    public function notify($message): void
    {
        $this->dispatch('notification', body: $message);
    }
}
