<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseSheet extends Model
{

    protected $fillable = [
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function non_fixed_expense_rows() {
        return $this->hasMany(NonFixedExpenseRow::class);
    }

    public function fixed_expense_rows() {
        return$this->hasMany(FixedExpenseRow::class);
    }

    public function getSum() {
        $sum = 0.00;
        foreach ($this->fixed_expense_rows as $fixed_expense_row) {
            $sum += $fixed_expense_row->getTotal();
        }

        foreach ($this->non_fixed_expense_rows as $non_fixed_expense_row) {
            if (!$non_fixed_expense_row->refused) {
                $sum += $non_fixed_expense_row->amount;
            }
        }

        return $sum;
    }

}
