<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  =>  ['required', 'string'],
            'email' =>  ['required', 'string', 'email', Rule::unique('users', 'email')],
            'password'  =>  ['required', Password::defaults()],
        ];
    }
}
