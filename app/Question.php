<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Question extends Model
{

    protected $fillable = [
        'title',
        'name',
        'email',
        'description',
        'created_at'
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%$keyword%")
                    ->orWhere("description", "LIKE","%$keyword%");
            });
        }
        return $query;
    }
}
