<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseMaterialResources extends JsonResource
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
            'id'=> $this->id,
            'course_heading'=> $this->courseOutline->headings,
            'material_file'=> $this->file,
            'filename'=> $this->file_name,
            'extension'=> $this->extension,
            'filesize'=> $this->size,
            'upload_date' => $this->created_at
        ];
    }
}
