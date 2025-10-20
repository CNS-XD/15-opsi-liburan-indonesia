<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            case 'backsite.blog.store':
                return [
                    'title' => 'required|string|max:255',
                    'description' => 'required',
                    'show' => 'required|in:0,1',
                    'type' => 'required|string|max:255',
                ];

            case 'backsite.blog.update':
                return [
                    'id' => 'exists:blogs,id',
                    'title' => 'required|string|max:255',
                    'description' => 'required',
                    'show' => 'required|in:0,1',
                    'type' => 'required|string|max:255',
                ];

            default:
                return [];
        }
    }
}
