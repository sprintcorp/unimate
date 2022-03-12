<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        return [
            'department_id' => 'required|exists:departments,id',
            'course_title' => 'string|required',
            'course_code' => 'string|required',
            'level' => 'integer|required',
            'semester' => 'string|required:in:first,second',
        ];
    }
}
