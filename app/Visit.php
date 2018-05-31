<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'visit_date', 'appointment', 'arriving_time', 'start_time_interview', 'departure_time', 'user_id', 'doctor_id'
    ];

    public function visitor() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
