<?php

namespace App\Http\Controllers;

use App\Page;
use App\Slider;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function showPage($slug)
    {
        $sliders = Slider::where('is_active',1)->orderBy('id','desc')
                    ->take(config('configuration.paging_slider'))
                    ->get();
                    
        $page = Page::whereSlug($slug)->firstOrFail();
        return view('page.show')
                ->withPage($page)
                ->withSliders($sliders);
    }
}
