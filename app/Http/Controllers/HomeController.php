<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Library\SimplexMethod;
use App\Library\Minimization;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $valuesArray = array();
    //$num[0]=num of variables and $num[1]=num of constraints
    private $num = array();
    private $total_number;

    public function index()
    {
        //$FmyFunctions1 = new SimplexMethod;
        $FmyFunctions1 = new Minimization;
        $is_ok = $FmyFunctions1->is_ok();
        echo $is_ok;
    }

    public function home()
    {
        return view('front.index');
    }

    public function input(Request $request)
    {
        $data = array(
            'var'=> $request->input('var'),
            'cons'=> $request->input('cons'),
        );
        return view('front.input')->with('data',$data);
    }

    public function calculate_using_minimization_class(Request $request)
    {
        if($request->input('category') == 'maximization')
        {
            $maximization = new Maximization;
            $initial_tableau = $maximization->optimize($request);

            return view('front.result-maximization',[
                'maximization'=> $maximization 
                ])->with('initial_tableau',$initial_tableau);
        }
        else
        {
            $minimization = new Minimization;
            $initial_tableau = $minimization->optimize($request);

            return view('front.result-minimization',[
                'minimization'=> $minimization 
                ])->with('initial_tableau',$initial_tableau);
        }
    }

    private function print_dump($array)
    {
        echo "<pre>";
        print_r($array);
        die();
    }
}
