<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Feed extends Model {
   protected $fillable = array('title', 'done');
}
 