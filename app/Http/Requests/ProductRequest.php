<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest 
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */

    public function rules(): array {
        return [
            'name' => 'required|max:50',
            'code' => [ 'required', 'string', 'max:50', 'unique:products,code,' . $this->id ],
            'category_id' => [ 'required', 'exists:categories,id' ],
            'brand_id' => [ 'required', 'exists:brands,id' ],
            'price' => [ 'required', 'numeric', 'min:0' ],
            'quantity' => [ 'required', 'integer', 'min:0' ],
            'description' => [ 'nullable', 'string', 'max:255' ],
            'upload_file_path' => 'nullable|string',
            'image_url' => 'nullable',
            'image' => 'nullable|max:100',
        ];
    }
}
