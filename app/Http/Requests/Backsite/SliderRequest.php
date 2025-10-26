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
                    'slider' => 'mimes:jpeg,jpg,png,mp4,mov,avi,webm|max:20000',
                    'title' => 'required|string|max:255',
                    'type' => 'required|in:0,1',
                    'show' => 'required|in:0,1',
                ];
                break;
        }

        return $rules;
    }

    public function withValidator(LaravelValidator $validator): void
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('slider')) {
                $file = $this->file('slider');

                // Deteksi MIME
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                $allowedMimes = [
                    'image/jpeg', 'image/png',
                    'video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/webm',
                ];

                // Validasi jenis file
                if (!in_array($mime, $allowedMimes)) {
                    $validator->errors()->add('slider', 'The file must be a JPG, PNG, or video (MP4, MOV, AVI, WEBM).');
                }

                // Validasi konten berbahaya hanya untuk file gambar (tidak untuk video)
                if (str_starts_with($mime, 'image/')) {
                    $content = file_get_contents($file->getPathname());
                    if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                        $validator->errors()->add('slider', 'The file contains harmful content.');
                    }
                }
            }
        });
    }
}
