<?php

namespace App\Http\Resources\Institution;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'department_id' => $this->id,
            'department_name' => $this->name,
            'faculty_id' => $this->faculty->id,
            'faculty_name' => $this->faculty->name,
            'university_id' => $this->faculty->university->id,
            'university_name' => $this->faculty->university->name,
        ];
    }
}
