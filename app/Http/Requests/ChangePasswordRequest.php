<?php

namespace App\Http\Requests;

use App\Validation\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Void_;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required', new CheckPassword],
            'password' => [
                'required',
                'string',
                'min:10',
                'regex:/[0-9]/',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[@$!%*?&#]/',
                'confirmed',
            ],
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function fulfill(): void
    {
        if (!$this->user()->hasChangedPassword()) {
            $this->user()->markPasswordAsChanged();
        }
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Please enter your current password.',
            'password.required' => 'Please enter your new password.',
            'password.min' => 'Your password must be at least 10 characters long.',
            'password.regex' => 'Your password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.confirmed' => 'Your passwords do not match.',
            'password_confirmation.required' => 'Please confirm your new password.',
            'password_confirmation.same' => 'Your passwords do not match.'
        ];
    }
}
