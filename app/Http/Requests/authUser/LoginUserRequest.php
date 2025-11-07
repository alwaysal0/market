<?php

namespace App\Http\Requests\authUser;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'username' => 'required|string|min:4|max:30',
            'password' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[\W_]).+$/',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 6 characters',
            'username.max' => 'Username must be less than 30 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ];
    }
}
