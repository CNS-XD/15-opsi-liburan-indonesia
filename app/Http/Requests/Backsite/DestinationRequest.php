<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
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

        switch ($route) {
            case 'backsite.destination.store':
                return [
                    'title'  => 'required|string|max:255|unique:destinations,title',
                ];

            case 'backsite.destination.update':
                return [
                    'id'     => 'exists:destinations,id',
                    'title'  => 'required|string|max:255|unique:destinations,title,' . $this->route('destination'),
                ];

            default:
                return [];
        }
    }
}
