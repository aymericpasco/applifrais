<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonFixedExpenseRow extends Model
{

    protected $fillable = [
        'wording', 'amount', 'expense_date', 'refused'
    ];

    protected $touches = ['expense_sheet'];

    public function expense_sheet() {
        return $this->belongsTo(ExpenseSheet::class);
    }
}
