<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = ['username', 'password', 'is_active'];

    protected $hidden = ['password'];

    public function subAccounts()
    {
        return $this->hasMany(SubAccount::class);
    }
}
