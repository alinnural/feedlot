<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Requirement;
use App\RequirementNutrient;
use App\FeedNutrient;

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
        return view('formula.changelog')->with(compact('res'));
    }

    public function input(Request $request)
    {
        $this->validate($request, [
            'requirement_id'=> 'required'
        ]);
        $req_id = $request->requirement_id; 
        $request->session()->put('requirement_id',$req_id);
        $reqnuts = RequirementNutrient::SearchNutrient($req_id)->get();
        $feeds = Feed::pluck('name','id')->all();

        return view('formula.input-feed')
                ->with('reqnuts',$reqnuts)
                ->with(compact('feeds'));
    }

    public function calculate(Request $request)
    {
        $this->validate($request, [
            'harga'=> 'required'
        ]);

        $data["category"] = "minimization ";
        $feeds = $request->feeds;  
        $request->session()->put('feeds',$feeds);   
        $req_id = $request->session()->get('requirement_id');
        $reqnuts = $request->reqnuts;
        $harga = $request->harga;
        $request->session()->put('harga',$harga);  
        $i_var = 0;
        foreach($harga as $key => $value){
            $i_var ++;
            $data["var".$i_var] = $value;
        }

        $i_cons = 0;
        //contrainst untuk nutrisi ternak
        foreach($reqnuts as $key => $value){
            if($request->min_composition[$key] != 0){
                $i_cons++;

                $i = 1;
                foreach($feeds as $key2 => $value2){
                    $feednuts = FeedNutrient::SearchByNutrientAndFeed($value,$value2)->first();
                    //print_r($value->nutrient_id.",".$value2);
                    $data["cons".$i_cons."_".$i++] = $feednuts->composition;
                }
                $data["sign".$i_cons] = "greaterThan";
                $data["answer".$i_cons] = $request->min_composition[$key];
                if($request->max_composition[$key] > $request->min_composition[$key]){
                    $i_cons++;
                    
                    $i = 1;
                    foreach($feeds as $key2 => $value2){
                    $feednuts = FeedNutrient::SearchByNutrientAndFeed($value,$value2)->first();
                        $data["cons".$i_cons."_".$i++] = $feednuts->composition;
                    }
                    $data["sign".$i_cons] = "lessThan";
                    $data["answer".$i_cons] = $request->max_composition[$key];
                }
            }            
        }
        
        //contraint untuk komposisi feed
        foreach($feeds as $key => $value){
            for($x=1;$x<=2;$x++){ // untuk min dam max composition
                $i_cons++;
                $i = 1;
                foreach($feeds as $key2 => $value2){
                    if($key2==$key){
                        $data["cons".$i_cons."_".$i++] = 1;
                    }else{
                        $data["cons".$i_cons."_".$i++] = 0;
                    }
                }
                if($x == 1){
                    $data["sign".$i_cons] = "greaterThan";
                    $data["answer".$i_cons] = $request->min_feed[$key];
                }else{
                    $data["sign".$i_cons] = "lessThan";
                    $data["answer".$i_cons] = $request->max_feed[$key];
                }
            }
        }
        $constraint = $i_cons;
        $data["numbers"] = count($feeds).",".$constraint;

        $requirement = array();
        $no=0;
        foreach($request->reqnuts_name as $key => $value)
        {
            $requirement[$no]['id'] = $reqnuts[$key];
            $requirement[$no]['name'] = $value;
            $requirement[$no]['min_composition'] = $request->min_composition[$key];
            $requirement[$no]['max_composition'] = $request->max_composition[$key];
            $no++;
        }
        //print_r($requirement); exit();
        $minimization = new MinimizationFeedlot;
        $initial_tableau = $minimization->optimize($data);

        return view('formula.result',[
            'minimization'=> $minimization,
             'requirement' => $requirement
            ])->with('initial_tableau',$initial_tableau);
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
            //print_r($request->all()); exit();
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
