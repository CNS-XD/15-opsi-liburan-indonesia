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
            'message' => 'Validasi gagal.',
            'errors' => $validator->errors(),
        ], 422));
    }

    public function messages(): array
    {
        return [
            // Form Header messages
            'judul.required' => 'Kolom judul wajib diisi.',
            'judul.string' => 'Kolom judul harus berupa teks.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
            'deskripsi.string' => 'Kolom deskripsi harus berupa teks.',
            'file_background.file' => 'File background harus berupa file.',
            'file_background.mimes' => 'File background harus berupa gambar atau video (jpg, jpeg, png, mp4).',
            'file_background.max' => 'Ukuran file background maksimal 20 MB.',
            'file_ilustrasi.file' => 'File ilustrasi harus berupa file.',
            'file_ilustrasi.mimes' => 'File ilustrasi harus berupa gambar (jpg, jpeg, png).',
            'file_ilustrasi.max' => 'Ukuran file ilustrasi maksimal 5 MB.',

            // Form Sponsor messages
            'nama.required' => 'Nama sponsor wajib diisi.',
            'nama.string' => 'Nama sponsor harus berupa teks.',
            'nama.max' => 'Nama sponsor maksimal 255 karakter.',
            'file_sponsor.required' => 'File sponsor wajib diunggah.',
            'file_sponsor.file' => 'File sponsor harus berupa file.',
            'file_sponsor.mimes' => 'File sponsor harus berupa gambar (jpg, jpeg, png).',
            'file_sponsor.max' => 'Ukuran file sponsor maksimal 5 MB.',

            // Form Kontak Umum messages
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Silakan masukkan alamat email yang valid.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',

            // Form Kontak Sosmed messages
            'jenis_sosmed.required' => 'Jenis sosial media wajib diisi.',
            'jenis_sosmed.string' => 'Jenis sosial media harus berupa teks.',
            'nama_akun.required' => 'Nama akun wajib diisi.',
            'nama_akun.string' => 'Nama akun harus berupa teks.',
            'url.required' => 'URL wajib diisi.',
            'url.url' => 'URL tidak valid.',
        ];
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
