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
        $sliders = Slider::where('is_active',1)->orderBy('id','desc')
                        ->take(config('configuration.paging_slider'))
                        ->get();

        $posts = Post::where('is_draft',0)->where('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'desc')
                    ->paginate(config('configuration.paging_news'))
                    ->setPath('post');

        return view('formula.beranda')
                    ->with(compact('posts'))
                    ->with(compact('sliders'));
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
        $request->session()->put('max_composition',$request->max_composition);
        $request->session()->put('min_composition',$request->min_composition); 
        
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
                    $data["answer".$i_cons] = $request->min_feed[$key]/100;
                }else{
                    $data["sign".$i_cons] = "lessThan";
                    $data["answer".$i_cons] = $request->max_feed[$key]/100;
                }
            }
        }

        //constraint untuk total
        $i_cons++;
        $i = 1;
        foreach($feeds as $feed){
            $data["cons".$i_cons."_".$i++] = 1;
        }
        $data["sign".$i_cons] = "lessThan";
        $data["answer".$i_cons] = 1;
        $i_cons++;
        $i = 1;
        foreach($feeds as $feed){
            $data["cons".$i_cons."_".$i++] = 1;
        }
        $data["sign".$i_cons] = "greaterThan";
        $data["answer".$i_cons] = 1;

        $constraint = $i_cons;
        $data["numbers"] = count($feeds).",".$constraint;
        //print_r($data); exit();
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
        $request->session()->put('requirement',$requirement);  
        //print_r($request->max_composition); exit();
        $minimization = new MinimizationFeedlot;
        $initial_tableau = $minimization->optimize($data);
        
        return view('formula.result',[
            'minimization'=> $minimization
            ])->with('initial_tableau',$initial_tableau);
    } 

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'total_price' => 'required',
            'explanation' => 'required'
        ]);

        $request->session()->put('store_ransum',$request->all());
        return redirect()->route('ransums.index');      
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

    public function AjaxCalcQ(Request $request)
    {
        if(empty($request->qty))
        {
            $data = array();
            return \Response::json($data);
        }
        else
        {            
            $kuantitas=0;
            $total_price_kuant=0;
            $text = "<div class='col-md-12'>".
                        "<div class='panel panel-default'>".
                            "<table class='table table-stripped'>".
                                "<tr>".
                                "<th>Pakan</th>".
                                "<th class='text-center'>Persentase</th>".
                                "<th width='10'>&nbsp;</th>".
                                "<th class='text-center' width='250'>Harga</th>".
                                "<th class='text-right' width='150'>Kuantitas</th>".
                                "<th width='50'>&nbsp;</th>".
                                "<th class='text-right' width='250'>Total Harga</th>".
                                "</tr>";
                                    
                foreach(Calculate::mapping_feed_id_result($request->harga_terakhir) as $feed){
                    $kuant = $feed['result']*$request->qty/100; $kuantitas+=$kuant;
                    $price_kuant = $feed['price']*$kuant; $total_price_kuant+=$price_kuant;
                    $text.= "<tr>".
                                "<td>".$feed['name']."</td>".
                                "<td><span class='align-center'>".$feed['result']." %</span></td>".
                                "<th>&nbsp;</th>".
                                "<td><span class='pull-left'>IDR</span> <span class='pull-right'>".$feed['price']." / kg</span></td>".
                                "<td><span class='pull-right'>".$kuant." kg</span></td>".
                                "<th>&nbsp;</th>".
                                "<td><span class='pull-left'>IDR</span><span class='pull-right'>".number_format($price_kuant, 2, ',', '.')."</span></td>".
                            "</tr>";
                }

                    $text .= "<tr>".
                                "<td width='300'><strong><h4>Harga Terakhir</strong></h4></td>".
                                "<td>&nbsp;</td>".
                                "<th>&nbsp;</th>".
                                "<td><strong><h4><span class='pull-left'>IDR</span> <span class='pull-right'>".round($request->harga_terakhir)." /kg</span></h4></strong></td>".
                                "<td><span class='pull-right'><h4>".$kuantitas." kg</h4></span></td>".
                                "<th>&nbsp;</th>".
                                "<td><strong><h4><span class='pull-left'>IDR</span><span class='pull-right'>".number_format($total_price_kuant, 2, ',', '.')."</h4></span></td>".
                            "</tr>".
                        "</table>".
                    "</div>".
                "</div>";

            return \Response::json($text);
        }
    }
    
    public function print(Request $request)
    {
        $id = $request->id;
        $data = array();
        $data["kuantitas"] = $request->kuantitas;
        $data["forsum"] = Forsum::findOrFail($id);;
        $data["forfeeds"] = ForsumFeed::SearchByForsum($id)->get();
        $data["fornuts"] = ForsumNutrient::SearchByForsum($id)->get();
        //print_r($data["forsum"]); exit();
        //return view('formula.print')->with(compact('data'));
        $pdf = PDF::loadView('formula.print', $data)->setPaper('a4', 'potrait')->setWarnings(false)->save('myfile.pdf');
        return $pdf->download($data["forsum"]->name.'.pdf');
    }

    public function laktasi()
    {
        $feeds = Feed::pluck('name','id')->all();

        return view('formula.laktasi')
                ->with(compact('feeds'));
    }

    public function calc_laktasi(Request $request)
    {
        $this->validate($request, [
            'bb'=> 'required',
            'ps'=> 'required',
            'bl'=> 'required'
        ]);

        $data = $request->all();
        
        #  Kebutuhan
        $kebutuhan = array();
        $kebutuhan["Bahan Kering"]["persen"] = (2.48 - (0.002 * $request->bb) + (0.082 * $request->ps));
        $kebutuhan["Bahan Kering"]["satuan"] = $kebutuhan["Bahan Kering"]["persen"]*$request->bb/100;
        
        if($request->bl < 7){
            $kebutuhan["TDN"]["satuan"] = (0.46 + (7.743 * $request->bb/1000) + (2.053 * $request->bb/pow(1000,2)) + (0.326 * $request->ps));
            $kebutuhan["TDN"]["persen"] = $kebutuhan["TDN"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;
            $kebutuhan["Protein"]["satuan"] = 0.040 + (0.8 * $request->bb/1000) - (0.2 * pow(($request->bb/1000),2)) - 0.003 + (0.0872 * $request->ps) ;
            $kebutuhan["Protein"]["persen"] = $kebutuhan["Protein"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;
            $kebutuhan["Kalsium"]["satuan"] = 2.9343 + (32.9714 * $request->bb/1000) - 5.7143 * pow(($request->bb/1000),2) + (2.7 * $request->ps);
            $kebutuhan["Kalsium"]["persen"] = $kebutuhan["Kalsium"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;
            $kebutuhan["Posfor"]["satuan"] = 1.7914 + (30.6571 * $request->bb/1000) - 8.5714 * pow(($request->bb/1000),2) + (1.8 * $request->ps);
            $kebutuhan["Posfor"]["persen"] = $kebutuhan["Posfor"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;   
        }
        else
        {
            $kebutuhan["TDN"]["satuan"] = (0.46 + (7.743 * $request->bb/1000) + (2.053 * $request->bb/pow(1000,2)) + (0.326 * $request->ps)) + (1.002 + 0.008 * $request->bb);
            $kebutuhan["TDN"]["persen"] = $kebutuhan["TDN"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;
            $kebutuhan["Protein"]["satuan"] = 0.040 + (0.8 * $request->bb/1000) - (0.2 * pow(($request->bb/1000),2)) - 0.003 + (0.0872 * $request->ps) + 0.125 + (0.0014 * $request->ps)  ;
            $kebutuhan["Protein"]["persen"] = $kebutuhan["Protein"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;
            $kebutuhan["Kalsium"]["satuan"] = 2.9343 + (32.9714 * $request->bb/1000) - 5.7143 * pow(($request->bb/1000),2) + (2.7 * $request->ps)+ 6.64 + (0.0488 * $request->bb);
            $kebutuhan["Kalsium"]["persen"] = $kebutuhan["Kalsium"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;
            $kebutuhan["Posfor"]["satuan"] = 1.7914 + (30.6571 * $request->bb/1000) - 8.5714 * pow(($request->bb/1000),2) + (1.8 * $request->ps) + 4.7 + (0.0346 * $request->bb);
            $kebutuhan["Posfor"]["persen"] = $kebutuhan["Posfor"]["satuan"]/$kebutuhan["Bahan Kering"]["satuan"]*100;    
        }

        #  Pemberian
        $pemberian = array();            
        $pemberian["Bahan Kering"] = 0;
        $pemberian["TDN"] = 0;
        $pemberian["Protein"] = 0;
        $pemberian["Kalsium"] = 0;
        $pemberian["Posfor"] = 0;
        
        foreach($request->feeds as $key => $value){
            $bk = $request->kuantitas[$key]*(FeedNutrient::SearchByNutrientAndFeed(1,$value)->first()->composition)/100;            
            $pemberian["Bahan Kering"] += $bk;
            $pemberian["TDN"] += $bk*(FeedNutrient::SearchByNutrientAndFeed(7,$value)->first()->composition)/100;
            $pemberian["Protein"] += $bk*(FeedNutrient::SearchByNutrientAndFeed(3,$value)->first()->composition)/100;
            $pemberian["Kalsium"] += $bk*(FeedNutrient::SearchByNutrientAndFeed(8,$value)->first()->composition)/100*1000;
            $pemberian["Posfor"] += $bk*(FeedNutrient::SearchByNutrientAndFeed(9,$value)->first()->composition)/100*1000;
        }

        #  Hasil
        $hasil = array();
        foreach($pemberian as $key => $value){
            $hasil[$key] = $value - $kebutuhan[$key]["satuan"];
        }
        /*
        echo "<pre>";
        print_r($kebutuhan);print_r($pemberian);print_r($hasil); echo "</pre>"; exit();
        $data["category"] = "minimization ";
        $feeds = $request->feeds;  
        */
        
        return view('formula.result-laktasi')
                ->with(compact('data','kebutuhan','pemberian','hasil'));
    }

    //====================================================================================
    /*
        using nutrient group show
    */
    public function groupFeeds($id)
    {
        $groupfeed = GroupFeed::find($id);
        $feeds = $groupfeed->feeds()->paginate(5);
        
        return view('feeds.group-feeds')
            ->with(compact('feeds'))
            ->with(compact('groupfeed'));
    }

    public function explore()
    {
        $feeds = Feed::paginate(5);
        return view('feeds.explore')
                ->with(compact('feeds'));
    }

    public function showFeed($id)
    {
        $feed = Feed::find($id)->firstOrFail();
        $nutrients = $feed->feednutrients()->with('nutrient')->get();

        return view('feeds.show')
                ->with(compact('feed'))
                ->with(compact('nutrients'));
    }
}
