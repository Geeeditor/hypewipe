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
        'price',
        'description',
        'quest_cost',
        'quest_commission',
    ];
}
