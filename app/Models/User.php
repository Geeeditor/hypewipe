<?php

namespace App\Models;

use App\Models\QuestJob;
use App\Models\UserWallet;
use App\Models\UserWithdrawal;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'wallet_pin',
        'total_referred_users',
        'password',
        'referral_code',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function userWallet(): HasOne {
        return $this->hasOne(UserWallet::class);
    }

    public function userDeposits(): HasMany {
        return $this->hasMany(UserDeposit::class, 'users_email', 'email');
    }

    public function userWithdrawals(): HasMany {
        return $this->hasMany(UserWithdrawal::class, 'users_email', 'email');
    }
 
    public function questJob(): HasOne {
        return $this->hasOne(QuestJob::class);
    }

}
