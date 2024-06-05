<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('customers'), // Check for uniqueness in the 'customers' table
            ],
            'phoneNo' => ['required', 'regex:/^\d{3}-\d{7}|\d{3}-\d{4}$/'],
            'matric' => ['required', 'regex:/[a-dA-D]{1}+[iI]{1}+[2-9]+[1-9]+\d{4}/'],
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
            'password_confirmation' => 'required|same:password',
            recaptchaFieldName() => recaptchaRuleName()
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please fill up the name',
            'email.required' => 'Please fill up the email',
            'email.unique' => 'The email address you provided is already associated with an existing account. Please use a different email address or log in if this is your account',
            'phoneNo.required' => 'Please fill up the phone number',
            'password.required' => 'Please fill up the password',
            'matric.required' => 'Please fill up the matric number in the format [ABCD]I2xxxxx (e.g. AI220134)',
            'matric.regex' => 'Please fill up the matric number in the format [ABCD]I2xxxxx (e.g. AI220134)',
            'email.email' => 'Please enter a valid email address',
            'phoneNo.regex' => 'Please enter a valid phone number in the format xxx-xxxxxxx(x).',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one number, one lowercase letter, one uppercase letter, and one special character.',
            'password_confirmation.same' => 'The password confirmation must match the password',
            recaptchaRuleName() => 'Please ensure that you are a human!'
        ];
    }
}
