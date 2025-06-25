<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWithdrawal extends Model
{
    //

    // protected $table = 'user_withdrawals'; // Specify the table name
    // protected $primaryKey = 'users_email'; // Use the correct primary key

    protected $fillable = [
        'users_email',
        'transaction_status',
        'wallet_address',
        'wallet_name',
        'wallet_type',
        'wallet_id',
        'withdrawal_amount',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'users_email', 'email');
    }


}
