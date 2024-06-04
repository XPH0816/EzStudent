<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'phoneNo' => ['required', 'regex:/^\d{3}-\d{7}|\d{3}-\d{4}$/'],
            'matric' => ['required', 'regex:/[a-dA-D]{1}+[iI]{1}+[2-9]+[1-9]+\d{4}/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please fill up the name',
            'phoneNo.required' => 'Please fill up the phone number',
            'matric.required' => 'Please fill up the matric number in the format [ABCD]I2xxxxx (e.g. AI220134)',
            'matric.regex' => 'Please fill up the matric number in the format [ABCD]I2xxxxx (e.g. AI220134)',
            'email.email' => 'Please enter a valid email address',
            'phone.regex' => 'Please enter a valid phone number in the format xxx-xxxxxxx(x).',
        ];
    }
}
