<?php

namespace App\Http\Requests\Institution;

use Illuminate\Foundation\Http\FormRequest;

class FacultyRequest extends FormRequest
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
                'name' => 'required|string|max:100',
                'university_id' => 'integer|nullable|exists:universities,id',
            ];
        }
        return [
            'name' => 'required|string|max:100',
            'university_id' => 'integer|nullable|exists:universities,id',
        ];
    }
}
