<?php

namespace App\Http\Requests\Backsite\Beranda;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator as LaravelValidator;

class BerandaRequest extends FormRequest
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
            case 'backsite.beranda.store':
            case 'backsite.beranda.update':
                if ($jenis_form == 'form_header') {
                    $rules = [
                        'judul' => 'required|string|max:255',
                        'deskripsi' => 'required|string',
                        'judul_countdown' => 'nullable',
                        'countdown' => 'nullable',
                        'file_background' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:20000',
                        'file_ilustrasi' => 'nullable|file|mimes:jpg,jpeg,png|max:5000',
                        'running_text' => 'nullable',
                    ];
                }

                if ($jenis_form === 'form_sponsor') {
                    $isExist = $this->filled('nama');
                    
                    $rules = [
                        'nama' => 'required|string|max:255',
                        'url' => 'required|url',
                        'file_sponsor' => $isExist ? 'nullable|file|mimes:jpg,jpeg,png|max:5000' : 'required|file|mimes:jpg,jpeg,png|max:5000',
                    ];
                }

                if ($jenis_form == 'form_kontak_umum') {
                    $rules = [
                        'email' => 'required|email',
                        'telepon' => 'required',
                        'fax' => 'nullable',
                        'alamat' => 'required|string',
                        'latitude' => 'required',
                        'longitude' => 'required',
                    ];
                }

                if ($jenis_form === 'form_kontak_sosmed') {
                    $rules = [
                        'jenis_sosmed' => 'required|string',
                        'nama_akun' => 'required|string',
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
            // Validasi file "file_background"
            if ($this->hasFile('file_background')) {
                $file = $this->file('file_background');

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg', 'video/mp4'])) {
                    $validator->errors()->add('file_background', 'File background harus berupa gambar JPG, PNG atau video MP4.');
                }

                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('file_background', 'File background mengandung konten berbahaya.');
                }
            }

            // Validasi file "file_ilustrasi"
            if ($this->hasFile('file_ilustrasi')) {
                $file = $this->file('file_ilustrasi');

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg'])) {
                    $validator->errors()->add('file_ilustrasi', 'File ilustrasi harus berupa gambar JPG atau PNG.');
                }

                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('file_ilustrasi', 'File ilustrasi mengandung konten berbahaya.');
                }
            }

            // Validasi file "file_sponsor"
            if ($this->hasFile('file_sponsor')) {
                $file = $this->file('file_sponsor');

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                if (!in_array($mime, ['image/png', 'image/jpeg'])) {
                    $validator->errors()->add('file_sponsor', 'File sponsor harus berupa gambar JPG atau PNG.');
                }

                $content = file_get_contents($file->getPathname());
                if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                    $validator->errors()->add('file_sponsor', 'File sponsor mengandung konten berbahaya.');
                }
            }
        });
    }
}
