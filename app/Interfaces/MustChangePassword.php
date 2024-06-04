<?php

namespace App\Interfaces;

interface MustChangePassword
{
    /**
     * Determine if the user has changed their password.
     *
     * @return bool
     */
    public function hasChangedPassword();

    /**
     * Mark the given user's password as changed.
     *
     * @return bool
     */
    public function markPasswordAsChanged();

    /**
     * Send the acoount created notification.
     *
     * @return void
     */
    public function sendAccountCreatedNotification();

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForNotification();
}
