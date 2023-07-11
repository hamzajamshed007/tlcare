<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Applicants;

class AllServicesForBabySitter extends JsonResource
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
            "id" => $this->id,
            "user_id" => $this->user_id,
            "service_name" =>$this->service_name,
            "status" =>$this->status,
            "description" =>$this->description,
            "created_at" =>$this->created_at,
            "applied_or_not" => ($request->user_id ? NULL : (Applicants::where(['baby_sitter_id' => $request->baby_sitter_id, 'service_id' => $this->id])->first() ? "Applied" : "Apply")),
            "user" => $this->User,
            "Children" => $this->Children,
            "TimeSchedules" => $this->TimeSchedules,
        ];
    }
}
