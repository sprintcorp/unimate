<?php

namespace App\Http\Requests\Institution;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UniversityRequest extends FormRequest
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
        if($this->isMethod('PUT')){
            return [
                'name' => 'required|string|max:100|unique:universities,name,'.request()->id,
                'acronym' => 'nullable|string|max:20',
            ];
        }

        if (Route::current()->getName() == 'uploadUniversity') {
            return [
                'file' => 'required|max:1000000|mimes:xlsx,csv,xls',
            ];
        }

        return [
            'name' => 'required|string|max:100|unique:universities',
            'acronym' => 'nullable|string|max:20',
        ];
    }
}
