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
}
 