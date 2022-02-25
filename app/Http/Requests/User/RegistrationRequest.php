<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RegistrationRequest extends FormRequest
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
        if (Route::current()->getName() == 'update-profile') {
            return [
                'email' => 'nullable|string|email|max:100|unique:users,email,'.auth()->user()->id,
                'university_id' => 'integer|nullable|exists:universities,id',
                'role_id' => 'integer|nullable|exists:roles,id',
                'faculty_id' => 'integer|nullable|exists:faculties,id',
                'department_id' => 'integer|nullable|exists:departments,id',
                'password' => 'nullable|string|min:8',
                'firstname' => 'nullable|string',
                'lastname' => 'nullable|string',
                'phone' => 'string|nullable',
                'image' => 'max:20000|mimes:jpeg,jpg,png|nullable',
                'other_name' => 'string|nullable',
                'cgpa' => 'string|nullable',
                'level' => 'string|nullable',
            ];
        }
        return [
            'email' => 'required|string|email|max:100|unique:users',
            'university_id' => 'integer|nullable|exists:universities,id',
            'role_id' => 'integer|nullable|exists:roles,id',
            'faculty_id' => 'integer|nullable|exists:faculties,id',
            'department_id' => 'integer|nullable|exists:departments,id',
            'password' => 'required|string|min:8',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'string|nullable',
            'image' => 'max:20000|mimes:jpeg,jpg,png|nullable',
            'other_name' => 'string|nullable',
            'cgpa' => 'string|nullable',
            'level' => 'string|nullable',
        ];
    }
}
