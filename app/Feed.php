<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Feed extends Model 
{
    protected $fillable = [
        'name',
        'group_feed_id'
        ];

    public function groupfeed()
    {
        return $this->belongsTo('App\GroupFeed','group_feed_id','id');
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
 