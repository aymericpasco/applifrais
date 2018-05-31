<?php

namespace App;

use GoogleMaps\GoogleMaps;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function doctors() {
        return $this->hasMany(Doctor::class, 'office_id', 'id');
    }

}
