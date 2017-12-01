<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class ForsumNutrient extends Model 
{
    protected $fillable = [
        'forsum_id',
        'nutrient_id',
        'min',
        'max'
        ];

    public function forsum()
    {
        return $this->belongsTo('App\Forsum');
    }

    public function nutrient()
    {
        return $this->belongsTo('App\Nutrients');
    }
}
 