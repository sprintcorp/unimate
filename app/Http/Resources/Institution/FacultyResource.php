<?php

namespace App\Http\Resources\Institution;

use Illuminate\Http\Resources\Json\JsonResource;

class FacultyResource extends JsonResource
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
            'faculty_id' => $this->id,
            'faculty_name' => $this->name,
            'institution_id' => $this->university->id,
            'institution_name' => $this->university->name,
            'faculty_department' => DepartmentResource::collection($this->departments)
        ];
    }
}
