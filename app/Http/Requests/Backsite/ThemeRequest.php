<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
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
            case 'backsite.theme.update':
                return [
                    'color_1' => 'required',
                    'color_2' => 'nullable',
                ];

            default:
                return [];
        }
    }
}
