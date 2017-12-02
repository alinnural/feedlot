<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class ForsumNutrient extends Model 
{
    protected $fillable = [
        'forsum_id',
        'nutrient_id',
        'min',
        'max',
        'result'
        ];

    public function forsum()
    {
        return $this->belongsTo('App\Forsum');
    }

    public function nutrient()
    {
        return $this->belongsTo('App\Nutrient');
    }

    public function scopeSearchByForsum($query,$forsum_id)
    {
        if($forsum_id != '')
        {
            $query->join('forsums', function ($join) use ($forsum_id) {
                $join->on('forsums.id', '=', 'forsum_id');
            })->where('forsum_id','=',$forsum_id);
            return $query;
        }
        else
        {
            return $query;
        }
    }
}
 