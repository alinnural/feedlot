<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Feed extends Model 
{
    protected $fillable = ['feed_stuff','group_feed_id',];

    public function groupfeed()
    {
        return $this->belongsTo('App\GroupFeed','group_feed_id','id');
    }
}
 