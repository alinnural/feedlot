<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    // Add the following near the top of the class, after $dates
    protected $fillable = [
        'answer',
        'question_id',
        'user_id'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
