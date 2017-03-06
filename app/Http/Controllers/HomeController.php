<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Requirement;

use App\Library\SimplexMethod;
use App\Library\Minimization;
use App\Library\Maximization;
use App\Library\MinimizationFeedlot;
use App\Helpers\Calculate;
use App\Helpers\Curl;

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

    public function beranda()
    {
        return view('formula.beranda');
    }

    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('formula.about');
    }

    public function contact()
    {
        return view('formula.contact');
    }

    public function changelog()
    {
        // a simple way to get a user's repo
        $res = Curl::curl_get_contents("https://api.github.com/repos/ihsanarifr/feedlot/releases");
        $res = json_decode($res);
        echo "<pre>";
        print_r($res);
        //return view('formula.changelog');
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

        // print_r($feed_price);
        // die();

        $feed_prices = Calculate::generate_feeds_price($feed_price,$request->input('feeds_price_id'));
        $request->session()->put('feed_price',$feed_prices);        

        // ambil kandungan tiap pakan
        $feed = Feed::WhereIn('id',$feed_id)->get();

        // ambil kebutuhan sesuai dengan requirement
        $requirement = Requirement::Where('id',$requirement_id)->get();

        // generate feed array
        $feeds = Calculate::generate_feeds($feed);

        // generate requirement array
        $requirements = Calculate::generate_requirements($requirement);

        // generate sign greaterthan or lessthan
        $sign = Calculate::generate_sign();

        $data = array(
            'feed_price'=>$feed_price,
            'requirement'=>$requirements,
            'feed'=>$this->array_transpose($feeds),
            'numbers'=>count($feeds).",5",
            'sign'=>$sign
        );

        $minimization = new MinimizationFeedlot;
        $initial_tableau = $minimization->optimize($data);
        //print_r($initial_tableau);
        return view('formula.result',[
                'minimization'=> $minimization 
                ])->with('initial_tableau',$initial_tableau)
                ->with(compact('requirement'));
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
            //print_r();
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
