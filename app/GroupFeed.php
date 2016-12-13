<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupFeed extends Model
{
    protected $fillable = ['name'];

    public function feeds()
    {
        return $this->hasMany('App\Feed');
    }
}
