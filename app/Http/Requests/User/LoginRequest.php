<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class LoginRequest extends FormRequest
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
        if (Route::current()->getName() == 'reset') {
            return [
                'email' => 'required|string|email|exists:users,email',
            ];
        }

        if (Route::current()->getName() == 'password-reset') {
            return [
                'password' => 'required|string|min:8'
            ];
        }

        return [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:8'
        ];
    }
}
