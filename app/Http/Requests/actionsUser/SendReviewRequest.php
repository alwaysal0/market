<?php

namespace App\Http\Requests\actionsUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendReviewRequest extends FormRequest
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
            'message' => 'required|min: 10',
            'rating' => 'required|integer|between:1,5',
        ];
    }
    public function messages(): array
    {
        return [
            'message.required' => 'Message is required',
            'message.min' => 'Message must be at least 10 characters.',
            'rating.required' => 'Rating is required',
        ];
    }
}
