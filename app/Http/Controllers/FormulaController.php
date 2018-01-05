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

class FormulaController extends Controller
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
        $request->session()->put('max_feed',$request->max_feed);
        $request->session()->put('min_feed',$request->min_feed); 
        
        $req_id = $request->session()->get('requirement_id');
        $reqnuts = $request->reqnuts;
        $harga = $request->harga;
        $request->session()->put('harga',$harga);  
        
        $i_cons = 0;
        //contrainst untuk nutrisi ternak
        foreach($reqnuts as $key => $value){
            if($req_id != 11){
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
            else
            {
                $i_cons++;
                
                $i = 1;
                foreach($feeds as $key2 => $value2){
                    $feednuts = FeedNutrient::SearchByNutrientAndFeed($value,$value2)->first();
                    //print_r($value->nutrient_id.",".$value2);
                    if($feednuts!=null)
                        $data["cons".$i_cons."_".$i++] = $feednuts->composition;
                    else
                        $data["cons".$i_cons."_".$i++] = 0;
                }
                $data["sign".$i_cons] = "greaterThan";
                $data["answer".$i_cons] = $request->min_composition[$key];
                if($request->max_composition[$key] > $request->min_composition[$key]){
                    $i_cons++;
                    
                    $i = 1;
                    foreach($feeds as $key2 => $value2){
                    $feednuts = FeedNutrient::SearchByNutrientAndFeed($value,$value2)->first();
                        if($feednuts!=null)
                            $data["cons".$i_cons."_".$i++] = $feednuts->composition;
                        else
                            $data["cons".$i_cons."_".$i++] = 0;
                    }
                    $data["sign".$i_cons] = "lessThan";
                    $data["answer".$i_cons] = $request->max_composition[$key];
                }
            }           
        }
        
        $i_var = 0;
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
            $nilai_bk = FeedNutrient::SearchByNutrientAndFeed(1,$value)->first();
            $i_var++;
            $data["var".$i_var] = ($nilai_bk->composition)/100*$harga[$key];
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
            'explanation' => 'required'
        ]);

        $request->session()->put('store_ransum',$request->all());
        return redirect()->route('ransums.index');      
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
                            "<th rowspan=2 ><br>Pakan</th>".
                            "<th colspan=2 class='text-center'>Komposisi</th>".
                            "<th rowspan=2 class='text-center' width='150'><br>Harga BS (Rp/Kg)</th>".
                            "<th rowspan=2 class='text-right' width='150'><br>Kuantitas (Kg)</th>".
                            "<th rowspan=2 class='text-right' width='250'><br>Total Harga (Rp)</th>".
                        "</tr>".
                        "<tr>".
                            "<th class='text-center' width='250'>(%BK)</th>".
                            "<th class='text-center' width='250'>(%BS)</th>".
                        "</tr>";
                                    
                foreach(Calculate::mapping_feed_id_result($request->harga_terakhir) as $feed){
                    $kuant = $feed['result_bs']*$request->qty/100; $kuantitas+=$kuant;
                    $price_kuant = $feed['price']*$kuant; $total_price_kuant+=$price_kuant;
                    $text.= "<tr>".
                                "<td>".$feed['name']."</td>".
                                "<td class='text-center'>".number_format($feed['result'], 2, ',', '')."</td>".
                                "<td class='text-center'>".number_format($feed['result_bs'], 2, ',', '')."</td>".
                                "<td class='text-center'>".$feed['price']."</td>".
                                "<td><span class='pull-right'>".number_format($kuant, 2, ',', '')." </span></td>".
                                "<td class='text-right'>".number_format($price_kuant, 2, ',', '.')."</td>".
                            "</tr>";
                }

                    $text .= "<tr>".
                                "<td width='300'><strong><h4>Harga Terakhir</strong></h4></td>".
                                "<td><strong><h4><span class='pull-right'>Rp ".number_format(Session::get('harga_terakhir'), 2, ',', '.')." /kg</span></h4></strong></td>".
                                "<td><strong><h4><span class='pull-right'>Rp ".number_format(Session::get('harga_terakhir_bs'), 2, ',', '.')." /kg</span></h4></strong></td>".
                                "<th>&nbsp;</th>".
                                "<td><span class='pull-right'><h4>".round($kuantitas, 2)." kg</h4></span></td>".
                                "<td><strong><h4><span class='pull-right'>Rp ".number_format($total_price_kuant, 2, ',', '.')."</h4></span></td>".
                            "</tr>".
                        "</table>".
                    "</div>".
                "</div>";

            return \Response::json($text);
        }
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

    public function AjaxCalcLaktasi(Request $request)
    {
        if(empty($request->bb) || empty($request->ps) || empty($request->bl))
        {
            $data = array();
            return \Response::json($data);
        }
        else
        {            
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

            $text = "<table class='table table-stripped'>".
                        "<tr>".
                            "<th>Nutrien</th>".
                            "<th>Kebutuhan (kg/hari)</th>".
                        "</tr>";
            foreach($kebutuhan as $key => $value){
                $text .= "<tr>
                            <td>".$key."</td>
                            <td>".round($value["satuan"],2)."</td>
                        </tr>";
            }

            $text .= "</table>";

            return \Response::json($text);
        }
    }
}