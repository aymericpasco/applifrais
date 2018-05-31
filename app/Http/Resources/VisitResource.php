<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'visit_date' => Carbon::parse($this->visit_date)->format('d/m/Y'),
            'appointment' => (int)$this->appointment,
            'arriving_time' => Carbon::createFromTimeString($this->arriving_time)->format('H:i:s'),
            'start_time_interview' => Carbon::createFromTimeString($this->start_time_interview)->format('H:i:s'),
            'departure_time' => Carbon::createFromTimeString($this->departure_time)->format('H:i:s'),
            'user_id' => $this->visitor->id,
            'doctor_id' => $this->doctor->id,
            'visitor' => new UserResource($this->visitor),
            'doctor' => new DoctorResource($this->doctor),
        ];
    }
}
