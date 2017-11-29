<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Ransum;
use Session;
use Excel;
use Validator;

class RansumsController extends Controller
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
        if(request()->session()->has('store_ransum'))
        {

            $request = request()->session()->get('store_ransum');
            echo 'login'; exit();  
            return view('formula.index');
        }   
        else
        {
            $request = request()->session()->get('store_ransum');
            echo 'logout'; exit();  
            $this->validate($request, [
                'name'=> 'required',
                'total_price' => 'required'
            ]);
            echo 'bisa'; exit();
            $ransums = Ransum::create($request->all());
    
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $ransums->name"
            ]);
            $request->session()->flush();
            return view('formula.index');
        }
    }    
}
