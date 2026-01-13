<?php
namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class TourReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_tour' => [
                'required',
                'exists:tours,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'show' => [
                'required',
                Rule::in([0, 1]),
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id_tour.required' => 'Tour wajib diisi',
            'id_tour.exists'   => 'Tour tidak valid',

            'name.required' => 'Nama wajib diisi',
            'name.string'   => 'Nama harus berupa teks',
            'name.max'      => 'Nama maksimal 255 karakter',

            'description.required' => 'Review wajib diisi',
            'description.string'   => 'Review harus berupa teks',

            'rating.required' => 'Rating wajib diisi',
            'rating.integer'  => 'Rating harus berupa angka',
            'rating.min'      => 'Rating minimal 1',
            'rating.max'      => 'Rating maksimal 5',

            'show.required' => 'Status tampil wajib dipilih',
            'show.in'       => 'Status tampil tidak valid',

            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'image.max'   => 'Ukuran gambar maksimal 2MB',
        ];
    }
}
