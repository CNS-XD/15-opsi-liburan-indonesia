<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as LaravelValidator;

class TestimonyRequest extends FormRequest
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
            case str_contains($uri, "backsite/testimony"):
                $rules = [
                    'image' => 'mimes:jpeg,jpg,png,webp,svg|max:5000',
                    'name' => 'required|string|max:255',
                    'description' => 'required',
                    'rating' => 'required|integer',
                    'show' => 'required|in:0,1',
                ];
                break;
        }

        return $rules;
    }

    public function withValidator(LaravelValidator $validator): void
    {
        $validator->after(function ($validator) {
            // Validasi file "image"
            if ($this->hasFile('image')) {
                $file = $this->file('image');

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])) {
                    $validator->errors()->add('image', 'The image must be JPG, PNG, WEBP or SVG.');
                }

                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('image', 'The file contains harmful content.');
                }
            }
        });
    }
}
