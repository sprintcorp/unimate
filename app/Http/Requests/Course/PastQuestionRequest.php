<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PastQuestionRequest extends FormRequest
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
        if (Route::current()->getName() == 'updatePastQuestion') {
            return [
                'course_id' => 'required|exists:courses,id',
                'file' => 'max:1000000|mimes:pdf,doc,docx',
                'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1)
            ];
        }

        return [
            'course_id' => 'required|exists:courses,id',
            'file' => 'required|max:1000000|mimes:pdf,doc,docx',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
        ];
    }
}
