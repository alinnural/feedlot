<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    // Add the following near the top of the class, after $dates
    protected $fillable = [
        'title',
        'name',
        'email',
        'description'
    ];

    public function question()
    {
        return $this->belongTo('App\Question');
    }
}
