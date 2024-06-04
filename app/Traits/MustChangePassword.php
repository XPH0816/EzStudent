<?php

namespace App\Traits;

use App\Notifications\AccountCreated;
use Illuminate\Auth\Notifications\VerifyEmail;
trait MustChangePassword
{
    /**
     * Determine if the user has changed their password.
     *
     * @return bool
     */
    public function hasChangedPassword()
    {
        return ! is_null($this->password_changed_at);
    }

    /**
     * Mark the given user's password as changed.
     *
     * @return bool
     */
    public function markPasswordAsChanged()
    {
        return $this->forceFill([
            'password_changed_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the acoount created notification.
     *
     * @return void
     */
    public function sendAccountCreatedNotification()
    {
        $this->notify(new AccountCreated);
    }

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForNotification()
    {
        return $this->email;
    }
}
