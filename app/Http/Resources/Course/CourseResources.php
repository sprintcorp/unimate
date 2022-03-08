<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResources extends JsonResource
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
            'department_id' => $this->department->id,
            'department_name' => $this->department->name,
            'course_title' => $this->course_title,
            'course_code' => $this->course_code,
            'semester' => $this->semester,
            'level' => $this->level,
            'slug' => $this->slug,
            'course_outline' => $this->courseOutline,
        ];
    }
}
