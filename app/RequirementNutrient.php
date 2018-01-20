<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementNutrient extends Model
{

    protected $fillable = [
        'feed_id',
        'nutrient_id',
        'composition_max',
        'composition_min'
    ];

    public function requirement()
    {
        return $this->belongsTo('App\Requirement');
    }

    public function nutrient()
    {
        return $this->belongsTo('App\Nutrient');
    }

    public function scopeSearchNutrient($query, $req_id)
    {
        if ($req_id != '') {
            if ($req_id == 11) {
                $query->join('nutrients', function ($join) use ($req_id) {
                    $join->on('nutrients.id', '=', 'nutrient_id');
                })
                    ->where('requirement_id', '=', $req_id);
            } else {
                $query->join('nutrients', function ($join) use ($req_id) {
                    $join->on('nutrients.id', '=', 'nutrient_id');
                })
                    ->where('requirement_id', '=', $req_id)
                    ->where('min_composition', '>', '0');
            }
            return $query;
        } else {
            return $query;
        }
    }
}
 