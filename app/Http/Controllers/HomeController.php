<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Library\SimplexMethod;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $FmyFunctions1 = new SimplexMethod;
        $is_ok = ($FmyFunctions1->is_ok());
        echo $is_ok;
    }

    public function home(){
        return view('front.index');
    }

    public function input(Request $request){
        $data = array(
            'var'=> $request->input('var'),
            'cons'=> $request->input('cons'),
        );
        return view('front.input')->with('data',$data);
    }
}
