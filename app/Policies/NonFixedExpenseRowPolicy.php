<?php

namespace App\Policies;

use App\ExpenseSheet;
use App\User;
use App\NonFixedExpenseRow;
use Illuminate\Auth\Access\HandlesAuthorization;

class NonFixedExpenseRowPolicy
{
    use HandlesAuthorization;

    public function visitorNonFixedExpenseStore(User $currentUser, ExpenseSheet $sheet) {
        return ($sheet->user->id === $currentUser->id) && $currentUser->hasRole('visiteur');
    }

    public function visitorNonFixedExpenseDestroy(User $currentUser, ExpenseSheet $sheet) {
        return ($sheet->user->id === $currentUser->id) && $currentUser->hasRole('visiteur');
    }
}
