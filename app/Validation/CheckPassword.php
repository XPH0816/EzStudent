<?php

namespace App\Validation;

use Illuminate\Contracts\Validation\Rule;

class CheckPassword implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return password_verify($value, auth()->user()->password);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return 'Your current password is incorrect.';
    }
}
