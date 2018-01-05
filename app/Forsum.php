<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Forsum extends Model 
{
    protected $fillable = [
        'name',
        'total_price',
        'total_price_bs',
        'user_id',
        'explanation'
        ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function forsumfeeds()
    {
        return $this->hasMany('App\ForsumFeed');
    }

    public function forsumnutrients()
    {
        return $this->hasMany('App\ForsumNutrient');
    }
}
 