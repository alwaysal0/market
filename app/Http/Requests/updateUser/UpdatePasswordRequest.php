<?php

namespace App\Http\Requests\updateUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[\W_])(?=.*[a-zA-Z])(?!.*[^\x20-\x7E]).+$/|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.regex' => 'Password must contain only ASCII symbols, at least 1 letter, 1 number and 1 special character.',
            'password.confirmed' => 'Password does not match.',
        ];
    }
}
