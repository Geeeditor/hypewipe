<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWallet extends Model
{
    protected $table = 'user_wallets'; // Specify the table name
    protected $primaryKey = 'user_id'; // Use the correct primary key

    protected $fillable = [
        'wallet_balance',
        'wallet_id',
    ];

    /**
     * Get the user that owns the UserWallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userAvailableWallets(): HasMany
    {
        return $this->hasMany(UserAvailableWallet::class, 'user_wallet_id');
    }
}
