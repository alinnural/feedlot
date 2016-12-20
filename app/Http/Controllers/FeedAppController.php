<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedAppController extends Controller
{
    public function index()
	{ 
		return view('Feed/index');
	}
}
