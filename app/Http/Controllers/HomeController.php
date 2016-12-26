<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('formula.index');
    }

    public function home()
    {
        return view('home');
    }

    public function input(Request $request)
    {
        $requirement_id = $request->session()->get('requirement_id');
        $feeds = Feed::pluck('feed_stuff','id')->all();
        return View('formula.input-feed')->with(compact('feeds'));
    }
}
