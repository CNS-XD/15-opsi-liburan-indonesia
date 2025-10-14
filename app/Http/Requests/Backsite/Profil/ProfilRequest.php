<?php

namespace App\Http\Requests\Backsite\Profil;

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
            'email' => 'max:255',
            'password' => 'max:255',
            'foto_profil' => 'file|image|mimes:png,jpg,jpeg|max:2500',
            'foto_ktp' => 'file|image|mimes:png,jpg,jpeg|max:2500',
            'nama' => 'string|max:255',
            'no_hp' => 'max:255',
            'jenis_kelamin' => 'in:0,1',
            'tempat_lahir' => 'max:255',
            'tanggal_lahir' => 'date',
            'agama' => 'max:255',
            'nik' => 'max:255',
            'nip' => 'max:255',
            'no_identitas' => 'max:255',
            'negara' => 'max:255',
            'provinsi' => 'max:255',
            'kab_kota' => 'max:255',
            'kecamatan' => 'max:255',
            'desa_kel' => 'max:255',
            'kodepos' => 'max:255',
            'rt_rw' => 'max:255',
            'alamat' => 'max:1000',
            'pendidikan_terakhir' => 'max:255',
            'jurusan_terakhir' => 'max:255',
            'pekerjaan' => 'max:255',
            'jabatan' => 'max:255',
            'pangkat_golongan' => 'max:255',
            'instansi' => 'max:255',
            'instansi_unit_kerja' => 'max:255',
            'instansi_alamat' => 'max:255',
            'instansi_no_telepon' => 'max:255',
        ];
    }

    public function withValidator(LaravelValidator $validator)
    {
        $validator->after(function ($validator) {
            $filesToCheck = ['foto_profil', 'foto_ktp'];
    
            foreach ($filesToCheck as $field) {
                if ($this->hasFile($field)) {
                    $file = $this->file($field);
    
                    // Cek MIME
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($finfo, $file->getPathname());
                    finfo_close($finfo);
    
                    if (!in_array($mime, ['image/png', 'image/jpeg'])) {
                        $validator->errors()->add($field, 'File tidak valid. Hanya gambar JPG, PNG yang diizinkan.');
                    }
    
                    // Cek apakah benar-benar gambar
                    if (!exif_imagetype($file->getPathname())) {
                        $validator->errors()->add($field, 'File bukan gambar yang valid.');
                    }
    
                    // Cek konten berbahaya
                    $content = file_get_contents($file->getPathname());
                    if (preg_match('/<\?(php|html)|<script>|eval\(/i', $content)) {
                        $validator->errors()->add($field, 'File berbahaya terdeteksi.');
                    }
                }
            }
        });
    }    
}
