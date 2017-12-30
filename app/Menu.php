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

    public function scopeOrderPositionAndActive($query)
    {
        $menudatabase = $query->where('active','1')->orderBy('position','asc')->get();

        $menuactive = array();
        foreach($menudatabase as $key=>$menu)
        {
            $menuactive[$key]['id'] = $menu->id;
            $menuactive[$key]['name'] = $menu->name;
            $menuactive[$key]['url'] = $menu->url;
            $menuactive[$key]['is_parent'] = $menu->is_parent;
            $menuactive[$key]['parent_id'] = $menu->parent_id;
            $menuactive[$key]['have_child'] = $menu->have_child;
            $menuactive[$key]['page_id'] = $menu->page_id;
            $menuactive[$key]['slug'] = $menu->slug;
            $menuactive[$key]['type'] = $menu->type;
        }
        return $menuactive;
    }
}
