<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class GroupRequest extends FormRequest
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
        if (Route::current()->getName() == 'addUserToGroup') {
            return [
                'user_id.*' => 'required|exists:users,id',
//                'group_id' => 'required|exists:groups,id',
            ];
        }

        if (Route::current()->getName() == 'removeUserFromGroup') {
            return [
                'user_id.*' => 'required|exists:users,id',
            ];
        }

        if($this->isMethod('PUT')){
            return [
                'name' =>  'nullable|string',
                'description' => 'nullable|string',
            ];
        }

        return [
            'name' =>  'required|string',
            'description' => 'nullable|string',
        ];
    }
}
