<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_account_id',
        'account_number',
        'account_holder_name',
        'ifsc',
        'amount',
        'status'
    ];

    // Define the relationship with SubAccount
    public function subAccount()
    {
        return $this->belongsTo(SubAccount::class);
    }
}
