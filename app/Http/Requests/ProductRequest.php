<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            "description" => 'required|max:255',
            "price" => "required|numeric|min:0",
            "category_id" => "nullable|exists:categories,id",
            "tags" => "nullable|array",
            "tag.*" => "exists:tags,id",
            "image" => "nullable|image|mimes:png,jpg,jpeg,gif|max:2048"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter a product name',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot be negative',
            'image.image' => 'Please upload a valid image file',
            'image.mimes' => 'Image must be: JPEG, PNG, JPG, or GIF',
            'image.max' => 'Image size must not exceed 2MB'
        ];
    }
}
