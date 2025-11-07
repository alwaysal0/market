<?php

namespace App\Http\Requests\actionsAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminSearchUserRequest extends FormRequest
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
            'username' => 'required|string|min:4|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 4 characters',
            'username.max' => 'Username must be less than 30 characters',
        ];
    }
}
