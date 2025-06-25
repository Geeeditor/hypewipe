<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeposit extends Model
{
    // protected $table = 'user_deposits'; // Specify the table name
    // protected $primaryKey = 'users_email'; // Use the correct primary key

    protected $fillable = ['transaction_status', 'users_email', 'wallet_id', 'deposit_amount', 'transaction_status', 'crpto_option'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'users_email', 'email');
    }
}
