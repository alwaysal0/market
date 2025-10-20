<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadProductRequest extends FormRequest
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
            'name' => 'required|string|min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'description' => 'required|string|min:10',
            'price' => 'required|integer|min:5',
            'filters' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.min' => 'Product name must be at least 5 characters',
            'image.required' => 'Product image is required',
            'description.required' => 'Product description is required',
            'description.min' => 'Product description must be at least 10 characters',
            'price.required' => 'Product price is required',
        ];
    }
}
