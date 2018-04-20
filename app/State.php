<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function expense_sheets() {
        return $this->hasMany(ExpenseSheet::class);
    }
}
