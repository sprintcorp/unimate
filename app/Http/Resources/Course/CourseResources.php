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
            'department_id' => $this->department->id ?? NULL,
            'department_name' => $this->department->name ?? NULL,
            'course_title' => $this->course_title,
            'course_id' => $this->id,
            'course_code' => $this->course_code,
            'semester' => $this->semester,
            'level' => $this->level,
            'slug' => $this->slug,
            'course_outline' => $this->courseOutline ?? NULL,
        ];
    }
}
