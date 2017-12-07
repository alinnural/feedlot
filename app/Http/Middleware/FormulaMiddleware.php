<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use App\Menu as MenuDatabase;
use Auth;

class FormulaMiddleware
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
        if(!Auth::check()){ 
            return redirect('/login')->with("flash_notification", [
                "level"=>"danger",
                "message"=>"Anda harus login terlebih dahulu"
            ]);
        }

        return $next($request);
    }
}