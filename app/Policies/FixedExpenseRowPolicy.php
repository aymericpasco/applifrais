<?php

namespace App\Policies;

use App\ExpenseSheet;
use App\User;
use App\FixedExpenseRow;
use Illuminate\Auth\Access\HandlesAuthorization;

class FixedExpenseRowPolicy
{
    use HandlesAuthorization;

    public function visitorFixedExpenseStore(User $user, ExpenseSheet $sheet) {
        return ($sheet->user->id === $user->id) && $user->hasRole('visiteur');
    }
}
