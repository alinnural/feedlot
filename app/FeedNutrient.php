<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class FeedNutrient extends Model 
{
    protected $fillable = [
        'feed_id',
        'nutrient_id',
        'composition'
        ];

    public function feed()
    {
        return $this->belongsTo('App\Feed');
    }

    public function nutrient()
    {
        return $this->belongsTo('App\Nutrient');
    }

    public function scopeSearchByNutrientAndFeed($query,$nutrient_id,$feed_id)
    {
        if($feed_id != '' && $nutrient_id != '')
        {
            $query->join('nutrients', function ($join) use ($feed_id, $nutrient_id) {
                $join->on('nutrients.id', '=', 'nutrient_id')
                    ->where('feed_id', '=', $feed_id)
                    ->where('nutrient_id', '=', $nutrient_id);
            });
            return $query;
        }
        else
        {
            return $query;
        }
    }
}
 