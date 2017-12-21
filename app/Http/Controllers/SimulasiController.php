<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Session;
use App\Feed;
use App\Post;
use App\Forsum;
use App\Slider;
use App\Setting;
use App\GroupFeed;
use Carbon\Carbon;
use App\ForsumFeed;
use App\Requirement;
use App\FeedNutrient;
use App\Helpers\Curl;
use App\ForsumNutrient;
use App\Helpers\Calculate;
use App\RequirementNutrient;
use Illuminate\Http\Request;
use App\Library\Minimization;
use App\Library\Maximization;
use App\Library\SimplexMethod;
use App\Library\MinimizationFeedlot;

class SimulasiController extends Controller
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
    
    /* Sample Optimization using Simplex Method --------------------------------------------*/
    public function simulasiIndex()
    {
        return view('simulasi.index');
    }

    public function simulasiInput(Request $request)
    {
        $data = ['var' => $request->get('var'), 'cons'=> $request->get('cons')];
        return view('simulasi.input')->with('data',$data);
    }

    public function simulasiCalculate(Request $request)
    {
        if($request->input('category') == 'maximization')
        {
            $maximization = new Maximization;
            $initial_tableau = $maximization->optimize($request);

            return view('simulasi.result-maximization',[
                'maximization'=> $maximization 
                ])->with('initial_tableau',$initial_tableau);
        }
        else
        {
            $minimization = new Minimization;
            //print_r($request->all()); exit();
            $initial_tableau = $minimization->optimize($request);

            return view('simulasi.result-minimization',[
                'minimization'=> $minimization 
                ])->with('initial_tableau',$initial_tableau);
        }
    }

    public function simulasiSimplexMethod()
    {
        //$FmyFunctions1 = new SimplexMethod;
        $FmyFunctions1 = new Maximization;
        $is_ok = $FmyFunctions1->index();
        echo $is_ok;
    }

    function array_transpose($array, $selectKey = false) {
        if (!is_array($array)) return false;
        $return = array();
        foreach($array as $key => $value) {
            if (!is_array($value)) return $array;
            if ($selectKey) {
                if (isset($value[$selectKey])) $return[] = $value[$selectKey];
            } else {
                foreach ($value as $key2 => $value2) {
                    $return[$key2][$key] = $value2;
                }
            }
        }
        return $return;
    }     
}
