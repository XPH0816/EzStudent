<?php

namespace App\Listeners;

use App\Interfaces\MustChangePassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->user instanceof MustVerifyEmail && $event->user instanceof MustChangePassword && !$event->user->hasChangedPassword()) {
            $event->user->sendAccountCreatedNotification();
        }
    }
}
