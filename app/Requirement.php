<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = [
        'animal_type',
        'finish',
        'current',
        'adg',
        'dmi',
        'tdn',
        'nem',
        'neg',
        'cp',
        'ca',
        'p',
        'month_pregnant',
        'month_calvin',
        'peak_milk',
        'current_milk',
    ];
}
