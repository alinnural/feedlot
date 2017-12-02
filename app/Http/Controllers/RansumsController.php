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
                            'results'
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
                $forsums = Forsum::with('forsumfeeds','forsumnutrients');
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
            $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'total_price', 'name'=>'total_price', 'title'=>'Total Harga'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
            return view('ransums.index')->with(compact('html'));
        }
    }    

    public function show($id)
    {
        $forsum = Forsum::findOrFail($id);
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
}
