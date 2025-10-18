<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as LaravelValidator;

class ProfilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'password' => 'max:255',
            'phone' => 'max:255',
            'nationality' => 'max:255',
            'photo' => 'file|image|mimes:png,jpg,jpeg|max:5000',
        ];
    }

    public function withValidator(LaravelValidator $validator)
    {
        $validator->after(function ($validator) {
            $filesToCheck = ['photo'];
    
            foreach ($filesToCheck as $field) {
                if ($this->hasFile($field)) {
                    $file = $this->file($field);
    
                    // Cek MIME
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($finfo, $file->getPathname());
                    finfo_close($finfo);
    
                    if (!in_array($mime, ['image/png', 'image/jpeg'])) {
                        $validator->errors()->add($field, 'The file must be a JPG or PNG image.');
                    }
    
                    // Cek apakah benar-benar gambar
                    if (!exif_imagetype($file->getPathname())) {
                        $validator->errors()->add($field, 'The file is not a valid image.');
                    }
    
                    // Cek konten berbahaya
                    $content = file_get_contents($file->getPathname());
                    if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                        $validator->errors()->add($field, 'The file contains harmful content..');
                    }
                }
            }
        });
    }    
}
