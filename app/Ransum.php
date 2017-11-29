<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Ransum extends Model 
{
    protected $fillable = [
        'name',
        'total_price',
        'user_id'
        ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
 