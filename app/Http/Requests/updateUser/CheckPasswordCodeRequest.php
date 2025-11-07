<?php

namespace App\Http\Requests\updateUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckPasswordCodeRequest extends FormRequest
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
            'code' => 'required|digits:6'
        ];
    }
    public function messages(): array
    {
        return [
            'code.required' => 'Code is required.',
            'code.digits' => 'Code must be 6 digits.',
        ];
    }
}
