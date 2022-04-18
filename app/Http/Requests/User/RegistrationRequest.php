<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
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
                'email' => 'nullable|string|email|max:100|unique:users,email,'.auth()->user()->id.',id,deleted_at,NULL',
                'university_id' => 'integer|nullable|exists:universities,id',
//                'role_id' => 'integer|nullable|exists:roles,id',
                'faculty_id' => 'integer|nullable|exists:faculties,id',
                'department_id' => 'integer|nullable|exists:departments,id',
                'password' => 'nullable|string|min:8',
                'firstname' => 'nullable|string',
                'lastname' => 'nullable|string',
                'phone' => 'nullable|string|unique:students,phone,'.auth()->user()->id.',id,deleted_at,NULL',
                'username' => 'nullable|string|unique:users,username,'.auth()->user()->id.',id,deleted_at,NULL',
                'image' => 'max:20000|mimes:jpeg,jpg,png|nullable',
                'other_name' => 'string|nullable',
                'cgpa' => 'string|nullable',
                'level' => 'string|nullable',
                'birth_date' => 'date_format:Y-m-d|nullable|before:' . Carbon::now()->subYears(14)->format('Y-m-d'),
                'gender' => 'string|nullable',
            ];
        }

        if (Route::current()->getName() == 'accountSetup') {

            return [
                'university_id' => 'integer|nullable|exists:universities,id',
                'faculty_id' => 'integer|nullable|exists:faculties,id',
                'department_id' => 'integer|nullable|exists:departments,id',
                'course_id' => 'integer|nullable|exists:courses,id',
                'phone' => 'nullable|string|unique:students,phone,'.auth()->user()->id.',id,deleted_at,NULL',
                'username' => 'nullable|string|unique:users,username,'.auth()->user()->id.',id,deleted_at,NULL',
                'image' => 'max:20000|mimes:jpeg,jpg,png|nullable',
                'other_name' => 'string|nullable',
                'cgpa' => 'string|nullable',
                'level' => 'string|nullable',
                'birth_date' => 'date_format:Y-m-d|nullable|before:' . Carbon::now()->subYears(14)->format('Y-m-d'),
                'gender' => 'string|nullable',
            ];
        }

        if (Route::current()->getName() == 'register') {
            return [
                'email' => 'required|string|email|max:100|unique:users,email,NULL,id,deleted_at,NULL',
                'university_id' => 'integer|nullable|exists:universities,id',
//                'role_id' => 'integer|nullable|exists:roles,id',
                'faculty_id' => 'integer|nullable|exists:faculties,id',
                'department_id' => 'integer|nullable|exists:departments,id',
                'password' => 'required|string|min:8',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'phone' => 'string|nullable|unique:students,phone,NULL,id,deleted_at,NULL',
                'image' => 'max:20000|mimes:jpeg,jpg,png|nullable',
                'other_name' => 'string|nullable',
                'cgpa' => 'string|nullable',
                'level' => 'string|nullable',
                'birth_date' => 'date_format:Y-m-d|nullable|before:' . Carbon::now()->subYears(14)->format('Y-m-d'),
                'gender' => 'string|nullable',
                'username'=> 'string|nullable|unique:users,username,NULL,id,deleted_at,NULL',
            ];
        }
    }

    public function messages()
    {
        return [
            'birth_date.before' => 'Required age for profile must not be less than age 14',
        ];
    }
}
