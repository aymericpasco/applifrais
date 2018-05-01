<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function office() {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function visitor() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
