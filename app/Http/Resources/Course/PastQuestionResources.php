<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class PastQuestionResources extends JsonResource
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
            'course_title'=>$this->course->course_title,
            'course_code'=>$this->course->course_code,
            'course_id'=>$this->course->id,
            'question'=>$this->file,
            'thumbnail'=>$this->thumbnail,
        ];
    }
}
