<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use App\Menu as MenuDatabase;

class MenuMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menudatabase = MenuDatabase::all();
        Menu::make('MenuUtama',function($men) use ($menudatabase){
            foreach($menudatabase as $m){
                // jika punya parent
                if($m->parent_id != 0){
                    if($m->is_parent){
                        if($m->have_child){
                            $men->add($m->name,array('url'=>$m->url,'class' => 'menu-item menu-item-type-custom dropdown'))->id($m->id);
                        }else{
                            $men->add($m->name,array('url'=>$m->url,'class' => 'menu-item'))->id($m->id);
                        }
                    }else{
                        $men->add($m->name,array('url'=>$m->url,'class' => '','parent'=>$m->parent_id))->id($m->id);
                    }
                }else{
                    if($m->is_parent){
                        if($m->have_child){
                            $men->add($m->name,array('url'=>$m->url,'class' => 'menu-item menu-item-type-custom dropdown'))->id($m->id)
                                ->link->attr(array('class' => 'dropdown-toggle js-activated', 'data-toggle' => 'dropdown'));
                        }else{
                            $men->add($m->name,array('url'=>$m->url,'class' => 'menu-item'))->id($m->id);
                        }
                    }else{
                        $men->add($m->name,array('url'=>$m->url,'class' => 'menu-item'))->id($m->id);
                    }
                }
            }
        });
        return $next($request);
    }
}