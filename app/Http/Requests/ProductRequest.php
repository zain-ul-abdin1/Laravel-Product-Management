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
            "tags"=>"nullable|array",
            "tag.*"=>"exists:tags,id"
        ];
    }

    public function messages()
    {
        return [
            "price.min" => "Price cannot be negative",
            'name.required' => 'Please enter a product name',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot be negative'
        ];
    }
}
