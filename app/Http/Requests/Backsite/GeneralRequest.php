<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator as LaravelValidator;

class GeneralRequest extends FormRequest
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
        $route = $this->route()->getName();
        $jenis_form = $this->input('form_input');
        $rules = [];

        switch ($route) {
            case 'backsite.general.store':
            case 'backsite.general.update':
                if ($jenis_form === 'form_partner') {
                    $isExist = $this->filled('name');
                    
                    $rules = [
                        'name' => 'required|string|max:255',
                        'url' => 'required|url',
                        'file_partner' => $isExist ? 'nullable|file|mimes:jpg,jpeg,png|max:5000' : 'required|file|mimes:jpg,jpeg,png|max:5000',
                    ];
                }

                if ($jenis_form == 'form_contact_general') {
                    $rules = [
                        'email' => 'required|email',
                        'phone' => 'required',
                        'fax' => 'nullable',
                        'address' => 'required|string',
                        'latitude' => 'required',
                        'longitude' => 'required',
                    ];
                }

                if ($jenis_form === 'form_contact_socmed') {
                    $rules = [
                        'type_socmed' => 'required|string',
                        'name_account' => 'required|string',
                        'url' => 'required|url',
                    ];
                }

                break;

            default:
                $rules = [];
        }

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422));
    }

    public function withValidator(LaravelValidator $validator): void
    {
        $validator->after(function ($validator) {
            // Validasi file "file_partner"
            if ($this->hasFile('file_partner')) {
                $file = $this->file('file_partner');

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg'])) {
                    $validator->errors()->add('file_partner', 'Files must be JPG or PNG images.');
                }

                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('file_partner', 'The file contains malicious content.');
                }
            }
        });
    }
}
