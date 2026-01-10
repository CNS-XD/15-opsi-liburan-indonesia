<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Validation\Validator as LaravelValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourDestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_tour' => 'required|exists:tours,id',
            'id_destination' => 'required|exists:destinations,id',
        ];
    } 
}
