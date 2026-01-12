<?php
namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class TourPriceRequest extends FormRequest
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

            'pax' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('tour_prices')->where(function ($query) {
                    return $query->where('id_tour', $this->id_tour);
                }),
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'id_tour.required' => 'Tour wajib diisi',
            'id_tour.exists'   => 'Tour tidak valid',

            'pax.required' => 'Jumlah pax wajib diisi',
            'pax.integer'  => 'Pax harus berupa angka',
            'pax.min'      => 'Pax minimal 1',

            'price.required' => 'Harga wajib diisi',
            'price.numeric'  => 'Harga harus berupa angka',
            'price.min'      => 'Harga tidak boleh minus',
        ];
    }
}
