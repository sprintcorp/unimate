<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResources extends JsonResource
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
            'reminder_id' => $this->id,
            'reminder_subject' => $this->subject,
            'reminder_message' => $this->message,
            'reminder_date' => $this->reminder_time,
        ];
    }
}
