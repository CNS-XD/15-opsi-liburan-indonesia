<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
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
        $rules = [];

        switch ($route) {
            case 'backsite.user.store':
                $rules = [
                    'name'            => 'required|string|max:255',
                    'email'           => 'required|email|max:255',
                    'password'        => 'required|string|min:8',
                    'phone'           => 'max:255',
                    'nationality'     => 'string|max:255',
                    'status'          => 'required|in:0,1,2',
                ];
                break;

            case 'backsite.user.update':
                $rules = [
                    'name'            => 'required|string|max:255',
                    'email'           => 'required|email|max:255',
                    'password'        => 'nullable|string|min:8',
                    'phone'           => 'max:255',
                    'nationality'     => 'string|max:255',
                    'status'          => 'required|in:0,1,2',
                ];
                break;

            default:
                $rules = [];
        }

        return $rules;
    }
}
