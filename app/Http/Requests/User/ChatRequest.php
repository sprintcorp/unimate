<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ChatRequest extends FormRequest
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
        if (Route::current()->getName() == 'searchUser') {
            return [
                'search' => 'required|string',
            ];
        }

        if (Route::current()->getName() == 'addUserToChat') {
            return [
                'user_id' => 'required|exists:users,id',
            ];
        }

        return [
            'receiver_id' => 'nullable|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'group_id' => 'nullable|exists:groups,id',
            'message' => 'required|string',
            'type' => 'nullable|string',
        ];
    }
}
