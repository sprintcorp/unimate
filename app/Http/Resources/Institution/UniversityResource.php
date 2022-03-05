<?php

namespace App\Http\Resources\Institution;

use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
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
            'institution_id' => $this->id,
            'institution_name' => $this->name,
            'institution_acronym' => $this->acronym,
            'institution_faculties' => FacultyResource::collection($this->faculties)
        ];
    }
}
