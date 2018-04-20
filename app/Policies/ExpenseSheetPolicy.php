<?php

namespace App\Policies;

use App\User;
use App\ExpenseSheet;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ExpenseSheetPolicy
{
    use HandlesAuthorization;


    public function visitorIndex(User $currentUser, User $user) {
        return $currentUser->is($user) && $user->hasRole('visiteur');
    }

    public function visitorStore(User $currentUser, User $user) {
        return $currentUser->is($user) && $user->hasRole('visiteur');
    }

    public function visitorEdit(User $currentUser, User $user) {
        return $currentUser->is($user) && $user->hasRole('visiteur');
    }

    public function visitorShow(User $currentUser, ExpenseSheet $sheet) {
        return ($sheet->user->id === $currentUser->id) && $currentUser->hasRole('visiteur');
    }

    public function visitorPdf(User $currentUser, ExpenseSheet $sheet) {
        return ($sheet->user->id === $currentUser->id) && $currentUser->hasRole('visiteur');
    }


    public function accountantShow(User $user) {
        return $user->hasRole('comptable');
    }

    public function accountantCloseAll(User $currentUser, User $user) {
        return $currentUser->is($user) && $user->hasRole('comptable');
    }

    public function accountantConfirm(User $currentUser, ExpenseSheet $sheet) {
        return $currentUser->hasRole('comptable') && $sheet->state->name === 'CL';
    }

    public function accountantRefunded(User $currentUser, ExpenseSheet $sheet) {
        return $currentUser->hasRole('comptable') && $sheet->state->name === 'VA';
    }

}
