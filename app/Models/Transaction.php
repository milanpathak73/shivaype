<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['client_id', 'sub_account_id', 'amount', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function subAccount()
    {
        return $this->belongsTo(SubAccount::class);
    }
}
