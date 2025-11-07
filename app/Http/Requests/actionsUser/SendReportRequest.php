<?php

namespace App\Http\Requests\actionsUser;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SendReportRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric|min:0',
            'content' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'The content field is required.',
            'content.max' => 'The maximum allowed is 1000 characters.',
        ];
    }
}
