<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Nutrient extends Model 
{
    protected $fillable = [
        'name',
        'abbreviation',
        'unit_id'
        ];

    public function unit()
    {
        return $this->belongsTo('App\Unit','unit_id','id');
    }

    public function feednutrients()
    {
        return $this->hasMany('App\FeedNutrient');
    }

    public function forsumnutrients()
    {
        return $this->hasMany('App\ForsumNutrient');
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where('feed_stuff','LIKE',"%$keyword%");
                    // ->orWhere("feed_stuff", "LIKE","%$keyword%");
                    // ->orWhere("email", "LIKE", "%$keyword%")
                    // ->orWhere("blood_group", "LIKE", "%$keyword%")
                    // ->orWhere("phone", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
 