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

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("animal_type", "LIKE","%$keyword%");
                    // ->orWhere("email", "LIKE", "%$keyword%")
                    // ->orWhere("blood_group", "LIKE", "%$keyword%")
                    // ->orWhere("phone", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public function scopeSearchByCurrentWeightAndADG($query,$current,$adg)
    {
        if($adg != '' and $current != '')
        {
            $query->where(function ($query) use ($current,$adg) {
                $query->where("current","LIKE","$current%")
                    ->where("adg","LIKE","$adg%");
            });
            return $query;
        }
        else
        {
            return $query;
        }
    }

}
