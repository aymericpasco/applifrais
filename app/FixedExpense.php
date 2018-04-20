<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedExpense extends Model
{
    public function fixed_expense_rows() {
        return $this->hasMany(FixedExpenseRow::class);
    }
}
