<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedExpenseRow extends Model
{

    protected $fillable = [
        'quantity', 'fixed_expense',
    ];

    protected $touches = ['expense_sheet'];

    public function expense_sheet() {
        return $this->belongsTo(ExpenseSheet::class);
    }

    public function fixed_expense() {
        return $this->belongsTo(FixedExpense::class);
    }

    public function getTotal() {
        return $this->quantity * $this->fixed_expense->amount;
    }
}
