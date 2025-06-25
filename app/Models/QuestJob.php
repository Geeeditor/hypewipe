<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class QuestJob extends Model
{
    //
    protected $fillable = [
        'user_id', 'quest_done', 'earnings'
    ];


    /**
     * Get the user that owns the QuestJob
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
