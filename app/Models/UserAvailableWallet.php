<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAvailableWallet extends Model
{
    //


    protected $fillable = [
        'wallet_address',
        'wallet_name',
        'wallet_type',
        'user_wallet_id',
    ];

    /**
     * Get the user that owns the UserAvailableWallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userWallets(): BelongsTo
    {
        return $this->belongsTo(UserWallet::class, 'user_wallet_id', 'wallet_id');
    }
}
