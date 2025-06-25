<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminWallets extends Model
{
    //

    protected $fillable = [
        'wallet_address',
        'wallet_name',
        'wallet_type',
    ];
}
