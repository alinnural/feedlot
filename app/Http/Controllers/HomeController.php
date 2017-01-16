<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Requirement;

use App\Library\SimplexMethod;
use App\Library\Minimization;
use App\Library\Maximization;
use App\Library\MinimizationFeedlot;

/*
source : https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
Aturan Pembuatan Program
1. Methode harus menggunakan style camelcase example : indahnyaKebersamanaan
2. Class harus menggungakan style camelcase example : HomeController
3. Penggunaan variable harus menggunakan style underscore
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
        $request->session()->put('requirement_id',$request->session()->get('requirement_id'));
        
        $feeds = Feed::pluck('feed_stuff','id')->all();
        return View('formula.input-feed')->with(compact('feeds'));
    }

    public function price(Request $request)
    {
        //print_r($request->input('feeds'));
        $feed_id = $request->input('feeds');
        $request->session()->put('feed_id',$feed_id);

        $feeds = Feed::WhereIn('id',$feed_id)->get();
        // $this->print_dump($feeds);
        // die();
        return View('formula.input-price')->with(compact('feeds'));
    }

    public function calculate_using_minimization_class(Request $request)
    {
        $feed_price = $request->input('feeds_price');
        $feed_id = $request->session()->get('feed_id');
        $requirement_id = $request->session()->get('requirement_id');

        // ambil kandungan tiap pakan
        $feed = Feed::WhereIn('id',$feed_id)->get();

        // ambil kebutuhan sesuai dengan requirement
        $requirement = Requirement::Where('id',$requirement_id)->get();

        // generate feed array
        $feeds = array();
        $no=1;
        foreach($feed as $value)
        {
            $feeds[$no][1] = $value->dry_matter;
            $feeds[$no][2] = $value->total_digestible_nutrients;
            $feeds[$no][3] = $value->crude_protein;
            $feeds[$no][4] = $value->calcium;
            $feeds[$no][5] = $value->phosphorus;
            $no++;
        }

        // generate requirement array
        $requirements = array();
        foreach($requirement as $key=>$re)
        {
            $requirements[1]=$re->dmi;
            $requirements[2]=$re->tdn;
            $requirements[3]=$re->cp;
            $requirements[4]=$re->ca;
            $requirements[5]=$re->p;
        }

        $data = array(
            'feed_price'=>$feed_price,
            'requirement'=>$requirements,
            'feed'=>$this->array_transpose($feeds),
            'numbers'=>count($feeds).",5"
        );
        // print_r($data);
        // die();

        //echo count($feeds);
        //echo count($requirements);
        // for($i=1;$i<=5;$i++)
        // {
        //     for($j=1;$j<=2;$j++)
        //     {
        //         echo $i."_".$j." ".$data['feed'][$i][$j];
        //         echo "&nbsp;   ";
        //     }
        //     echo "  > ".$requirements[$i];
        //     echo "<br>";
        // }
        // $this->print_dump($data);
        $minimization = new MinimizationFeedlot;
        $initial_tableau = $minimization->optimize($data);
        //print_r($initial_tableau);
        return view('formula.result',[
                'minimization'=> $minimization 
                ])->with('initial_tableau',$initial_tableau);
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
            print_r();
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
