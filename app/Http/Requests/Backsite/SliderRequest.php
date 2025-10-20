<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as LaravelValidator;

class SliderRequest extends FormRequest
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
        $rules = [];
        $uri = $this->route()->uri;

        switch (true) {
            case str_contains($uri, "backsite/slider"):
                $rules = [
                    'title' => 'required|string|max:255',
                    'show' => 'required|in:0,1',
                    'slider' => 'mimes:jpeg,jpg,png|max:5000',
                ];
                break;
        }

        return $rules;
    }

    public function withValidator(LaravelValidator $validator): void
    {
        $validator->after(function ($validator) {
            // Validasi file "slider"
            if ($this->hasFile('slider')) {
                $file = $this->file('slider');

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg'])) {
                    $validator->errors()->add('slider', 'The file must be a JPG or PNG image.');
                }

                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('slider', 'The file contains harmful content.');
                }
            }
        });
    }
}
