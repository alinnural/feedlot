<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Helpers\Calculate;
use App\Feed;
use App\Nutrient;
use App\Forsum;
use App\ForsumFeed;
use App\ForsumNutrient;
use Session;
use Excel;
use Validator;
use Auth;
use App;
use PDF;

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
    public function index(Request $request, Builder $htmlBuilder)
    {
        if(Session::has('store_ransum'))
        {   
            $request = Session::get('store_ransum');
            $request['user_id'] = Auth::user()->id;
            $request['total_price'] = Session::get('harga_terakhir');
            $request['total_price_bs'] = Session::get('harga_terakhir_bs');
            $forsum = Forsum::create($request);

            foreach(Calculate::mapping_feed_id_result($forsum->total_price) as $feed){
                $forsumfeed['forsum_id'] = $forsum->id;
                $forsumfeed['feed_id'] = $feed['id'];
                $forsumfeed['min'] = $feed['min_feed'];
                $forsumfeed['max'] = $feed['max_feed'];
                $forsumfeed['price'] = $feed['price'];
                $forsumfeed['result'] = $feed['result'];
                $forsumfeed['result_bs'] = $feed['result_bs'];
                ForsumFeed::create($forsumfeed);
            }
            
            foreach(Session::get('nutrientresult') as $nut)
            {
                $forsumnut['forsum_id'] = $forsum->id;
                $forsumnut['nutrient_id'] = $nut['id'];
                $forsumnut['min'] = $nut['min_composition'];
                $forsumnut['max'] = $nut['max_composition'];
                $forsumnut['result'] = $nut['result'];
                ForsumNutrient::create($forsumnut);
            }
            Session::forget(
                            'store_ransum',
                            'requirement_id',
                            'feeds',
                            'max_composition',
                            'min_composition',
                            'harga',
                            'requirement',
                            'nutrientresult',
                            'results',
                            'harga_terakhir',
                            'max_feed',
                            'min_feed'
                            );

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $forsum->name pada daftar ransum Anda"
            ]);
            return redirect()->route('ransums.show', ['id' => $forsum->id]);
        }   
        else
        {            
            if ($request->ajax()) {
                if(Auth::user()->roles->first()->name == "admin")
                    $forsums = Forsum::with('forsumfeeds','forsumnutrients','user');
                else
                    $forsums = Forsum::with('forsumfeeds','forsumnutrients')->where('user_id',Auth::user()->id);
                
                return Datatables::of($forsums)
                    ->addColumn('group', function($forsums) {
                        return $forsums->name; })
                    ->addColumn('action', function($forsums){
                        return view('datatable._detail',[
                            'model' => $forsums,
                            'detail_url' => route('ransums.show',$forsums->id),
                            'delete_url' => route('ransums.destroy', $forsums->id),
                            'confirm_message' => 'Apakah Anda yakin akan menghapus '. $forsums->name . '?'
                        ]);
                    })->make(true);
            }
            if(Auth::user()->roles->first()->name == "admin")
            {
                $html = $htmlBuilder
                ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
                ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Pembuat'])
                ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
            }
            else
            {
                $html = $htmlBuilder
                ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
                ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
            }
            
            return view('ransums.index')->with(compact('html'));
        }
    }    

    public function show($id)
    {
        $forsum = Forsum::findOrFail($id);
        if(Auth::user()->id != 1)
        {
            if($forsum->user_id != Auth::user()->id)
                return redirect()->route('ransums.index');    
        }
            
        $forfeeds = ForsumFeed::SearchByForsum($id)->get();
        $fornuts = ForsumNutrient::SearchByForsum($id)->get();

        return view('ransums.show')->with(compact('forsum','forfeeds','fornuts'));
    }

    public function destroy(Request $request, $id)
    {
        $forsum = Forsum::find($id);
    
        if(!$forsum->delete()) 
            return redirect()->back();
        
        // handle hapus feeds via ajax
        if ($request->ajax()) 
            return response()->json(['id' => $id]);
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Feeds berhasil dihapus"
        ]);
        return redirect()->route('ransums.index');
    }

    public function AjaxCalcQ(Request $request)
    {
        if(empty($request->id))
        {
            $data = array();
            return \Response::json($data);
        }
        else
        {       
            $forfeeds = ForsumFeed::SearchByForsum($request->id)->get();     
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
                                    
                foreach($forfeeds as $item){
                    $kuant = $item->result_bs*$request->qty/100; $kuantitas+=$kuant;
                    $price_kuant = $item->price*$kuant; $total_price_kuant+=$price_kuant;
                    $text.= "<tr>".
                                "<td>".$item->feed->name."</td>".
                                "<td class='text-center'>".number_format($item->result, 2, ',', '')."</td>".
                                "<td class='text-center'>".number_format($item->result_bs, 2, ',', '')."</td>".
                                "<td class='text-center'>".$item->price."</td>".
                                "<td><span class='pull-right'>".number_format($kuant, 2, ',', '')."</span></td>".
                                "<td class='text-right'>".number_format($price_kuant, 2, ',', '.')."</td>".
                            "</tr>";
                }

                    $text .= "<tr>".
                                "<td width='300'><strong><h4>Harga Terakhir</strong></h4></td>".
                                "<td><strong><h4><span class='pull-right'>Rp ".round($request->harga_terakhir,2)." /kg</span></h4></strong></td>".
                                "<td><strong><h4><span class='pull-right'>Rp ".round($request->harga_terakhir_bs,2)." /kg</span></h4></strong></td>".
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
    
    public function print_forsum(Request $request)
    {
        $id = $request->id;
        $data = array();
        $data["qty"] = $request->kuantitas;
        $data["forsum"] = Forsum::findOrFail($id);;
        $data["forfeeds"] = ForsumFeed::SearchByForsum($id)->get();
        $data["fornuts"] = ForsumNutrient::SearchByForsum($id)->get();
        //print_r($data["forsum"]); exit();
        //return view('formula.print')->with(compact('data'));
        $pdf = PDF::loadView('ransums.print', $data)->setPaper('a4', 'potrait')->setWarnings(false)->save('myfile.pdf');
        return $pdf->download($data["forsum"]->name.'.pdf');
    }
}
