<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use HasFactory, Notifiable;

    // Specify the table if it's not the plural of the model name
    protected $table = 'notifications';

    // Specify the fillable fields
    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    // You can define relationships here if needed
    public function notifiable()
    {
        return $this->morphTo();
    }
}
