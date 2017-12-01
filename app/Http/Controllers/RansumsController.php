<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Helpers\Calculate;
use App\Forsum;
use App\ForsumFeed;
use App\ForsumNutrient;
use Session;
use Excel;
use Validator;
use Auth;

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
        if(Session::has('store_ransum'))
        {
            $request = Session::get('store_ransum');
            $request['user_id'] = Auth::user()->id;
            $forsum = Forsum::create($request);

            foreach(Calculate::mapping_feed_id_result($forsum->total_price) as $feed){
                $forsumfeed['forsum_id'] = $forsum->id;
                $forsumfeed['feed_id'] = $feed['id'];
                $forsumfeed['min'] = $feed['min_composition'];
                $forsumfeed['max'] = $feed['max_composition'];
                $forsumfeed['price'] = $feed['price'];
                $forsumfeed['result'] = $feed['result'];
                ForsumFeed::create($forsumfeed);
            }

            foreach(Session::get('requirement') as $nut)
            {
                $forsumnut['forsum_id'] = $forsum->id;
                $forsumnut['nutrient_id'] = $nut['id'];
                $forsumnut['min'] = $nut['min_composition'];
                $forsumnut['max'] = $nut['max_composition'];
                ForsumNutrient::create($forsumnut);
            }
            
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $forsum->name pada ransum"
            ]);
            return redirect()->route('ransums.detail');
        }   
        else
        {            
            return redirect()->route('ransums.index');
        }
    }    
}
