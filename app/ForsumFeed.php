<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class ForsumFeed extends Model 
{
    protected $fillable = [
        'forsum_id',
        'feed_id',
        'min',
        'max',
        'price',
        'result'
        ];

    public function forsum()
    {
        return $this->belongsTo('App\Forsum');
    }

    public function feed()
    {
        return $this->belongsTo('App\Feed');
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
 