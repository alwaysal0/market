<?php

namespace App\Http\Requests\actionsAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'username' => 'required|string|min:4|max:30|regex:/^[\x00-\x7F]+$/',
            'password' => ['nullable', 'regex:/^($|(?=.*[0-9])(?=.*[\W_])(?=.*[a-zA-Z])(?!.*[^\x20-\x7E]).+)$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.unique' => 'Email already exists',
            'email.max' => 'Email is too long',
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 4 characters',
            'username.max' => 'Username must be less than 30 characters',
            'password.min' => 'Password must be at least 6 characters.',
            'password.regex' => 'Password must contain only ASCII symbols, at least 1 letter, 1 number and 1 special character.',
            'password.confirmed' => 'Password does not match.',
        ];
    }
}
