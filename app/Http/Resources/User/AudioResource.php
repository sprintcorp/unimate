<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioResource extends JsonResource
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
            'audio'=> $this->audio_file,
            'filename'=> $this->file_name,
            'extension'=> $this->extension,
            'filesize'=> $this->size,
            'upload_date' => $this->created_at
        ];
    }
}
