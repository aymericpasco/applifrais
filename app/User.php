<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function expense_sheets() {
        return $this->hasMany(ExpenseSheet::class);
    }

    public function visits() {
        return $this->hasMany(Visit::class, 'user_id', 'id');
    }

    public function doctors() {
        return $this->hasMany(Doctor::class, 'user_id', 'id');
    }

    public function hasRole($roleName) {
        if ($this->role->name === $roleName) {
            return true;
        }
        return false;
    }

}
