<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    //
    protected $fillable = [
        'image',
        'make',
        'model',
        'year',
        'color',
        'vin',
        'mileage',
        'engine_type',
        'transmission',
        'fuel_type',
        'vmv',
        'description',
        'task_cost',
        'task_reward',
    ];
}
