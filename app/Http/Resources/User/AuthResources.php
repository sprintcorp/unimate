<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_email' => $this->email,
            'username' => $this->username,
            'user_role' => $this->role->name,
            'other_information' => $this->role_id == 1 ? $this->admin : $this->student,
        ];
    }
}
