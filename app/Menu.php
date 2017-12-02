<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    protected $fillable = ['name', 'url','is_parent','parent_id','have_child','menu_admin','active','position','page_id', 'slug','type'];
    /**
     * Set the title attribute and automatically the slug
     *
     * @param string $value
     */
}
