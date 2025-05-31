<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemFileRequest extends FormRequest 
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */

    public function rules(): array {
        return [
            // file validation is only for form_image. If new upload file type, need to fix.
            'file' => config( 'filesystems.business.form_image.rules' ),
        ];
    }
}
