<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

use App\Library\SimplexMethod;
use App\Library\Minimization;
use App\Library\Maximization;

/*
source : https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
Aturan Pembuatan Program
1. Methode harus menggunakan style camelcase example : indahnyaKebersamanaan
2. Class harus menggungakan style camelcase example : HomeController
3. Penggunaan variable harus menggunakan style 
*/

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

    public function calculate_using_minimization_class(Request $request)
    {
        $pakan = $request->input('feeds');
        $feeds = Feed::WhereIn('id',$pakan)->get();

        $this->print_dump($feeds);
    }

    /* Sample Optimization using Simplex Method --------------------------------------------*/
    public function sampleIndex()
    {
        return view('sample.index');
    }

    public function SampleInput(Request $request)
    {
        $data = ['var' => $request->get('var'), 'cons'=> $request->get('cons')];
        return view('sample.input')->with('data',$data);
    }

    public function sampleCalculate(Request $request)
    {
        if($request->input('category') == 'maximization')
        {
            $maximization = new Maximization;
            $initial_tableau = $maximization->optimize($request);

            return view('sample.result-maximization',[
                'maximization'=> $maximization 
                ])->with('initial_tableau',$initial_tableau);
        }
        else
        {
            $minimization = new Minimization;
            $initial_tableau = $minimization->optimize($request);

            return view('sample.result-minimization',[
                'minimization'=> $minimization 
                ])->with('initial_tableau',$initial_tableau);
        }
    }

    public function sampleSimplexMethod()
    {
        //$FmyFunctions1 = new SimplexMethod;
        $FmyFunctions1 = new Maximization;
        $is_ok = $FmyFunctions1->index();
        echo $is_ok;
    }
   
    private function print_dump($array)
    {
        echo "<pre>";
        print_r($array);
        die();
    }
}
