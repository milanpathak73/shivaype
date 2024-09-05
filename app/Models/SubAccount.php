<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SubAccount extends Authenticatable
{
    protected $fillable = ['client_id', 'username', 'password', 'is_active'];

    protected $hidden = ['password'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
