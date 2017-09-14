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
        return $this->belongsTo('App\Feed','feed_id','id');
    }

    public function nutrient()
    {
        return $this->belongsTo('App\Nutrient','nutrient_id','id');
    }
}
 