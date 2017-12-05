<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    //
    public function showPage($slug)
    {
        $page = Page::whereSlug($slug)->firstOrFail();
        return view('page.show')
                ->withPage($page);
    }
}
