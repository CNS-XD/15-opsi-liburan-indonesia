<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Validation\Validator as LaravelValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'       => 'nullable|mimes:jpeg,jpg,png,webp,svg|max:5000',
            'title'       => ['required', 'string', 'max:255', Rule::unique('tours', 'title')->ignore($this->tour)],
            'description' => 'required|string',
            'day_tour'    => 'required|integer|min:1|max:7',
            'time_tour'   => 'required|string|max:100',
            'type_tour'   => 'required|in:0,1',
            'price'       => 'required|numeric|min:0',
            'is_best'     => 'required|in:0,1',
            'group_size'  => 'required|string|max:50',
            'level_tour'  => 'required|in:Low,Medium,Hard',
            'show'        => 'required|in:0,1',
        ];
    }

    public function withValidator(LaravelValidator $validator): void
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('image')) {
                $file = $this->file('image');

                // MIME check
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])) {
                    $validator->errors()->add('image', 'The image must be JPG, PNG, WEBP or SVG.');
                }

                // Security check
                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('image', 'The image contains harmful content.');
                }
            }
        });
    }
}
