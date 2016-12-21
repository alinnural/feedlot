<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Feed;
use App\GroupFeed;
use Session;
use Excel;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request, Builder $htmlBuilder)
    {

        if ($request->ajax()) {
            $feeds = Feed::with('groupfeed');
            return Datatables::of($feeds)
                ->addColumn('group', function($feeds) {
                    return $feeds->groupfeed->name; })
                ->addColumn('action', function($feeds){
                    return view('datatable._action',[
                        'model' => $feeds,
                        'edit_url' => route('feeds.edit',$feeds->id),
                        'delete_url' => route('feeds.destroy', $feeds->id),
                        'confirm_message' => 'Are you sure to delete '. $feeds->name . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'feed_stuff', 'name'=>'feed_stuff', 'title'=>'Feed Staff'])
        ->addColumn(['data' => 'groupfeed.name', 'name'=>'groupfeed.name', 'title'=>'Group Feeds'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('feeds.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all());
        // die();
        $this->validate($request, [
            'feed_stuff'=> 'required|unique:feeds',
            'group_feed_id' => 'required',
            'dry_matter' => 'required',
            'mineral' => 'required',
            'organic_matter'=> 'required',
            'lignin'=> 'required',
            'neutral_detergent_fiber'=> 'required',
            'ether_extract'=> 'required',
            'nonfiber_carbohydrates'=> 'required',
            'total_digestible_nutrients'=> 'required',
            'metabolizable_energy'=> 'required',
            'rumen_degradable'=> 'required',
            'rumen_undegradable'=> 'required',
            'rumen_soluble'=> 'required',
            'rumen_insoluble'=> 'required',
            'degradation_rate'=> 'required',
            'crude_protein'=> 'required',
            'metabolizable_protein'=> 'required',
            'calcium'=> 'required',
            'phosphorus'=> 'required',
            'magnesium'=> 'required',
            'potassium'=> 'required',
            'sodium'=> 'required',
            'sulfur'=> 'required',
            'cobalt'=> 'required',
            'copper'=> 'required',
            'iodine'=> 'required',
            'manganese'=> 'required',
            'selenium'=> 'required',
            'zinc' => 'required'
        ]);
        $feeds = Feed::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $feeds->feed_stuff"
        ]);
        return redirect()->route('feeds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feeds = Feed::find($id);
        return view('feeds.edit')->with(compact('feeds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'feed_stuff'=> 'required',
            'group_feed_id' => 'required',
            'dry_matter' => 'required',
            'mineral' => 'required',
            'organic_matter'=> 'required',
            'lignin'=> 'required',
            'neutral_detergent_fiber'=> 'required',
            'ether_extract'=> 'required',
            'nonfiber_carbohydrates'=> 'required',
            'total_digestible_nutrients'=> 'required',
            'metabolizable_energy'=> 'required',
            'rumen_degradable'=> 'required',
            'rumen_undegradable'=> 'required',
            'rumen_soluble'=> 'required',
            'rumen_insoluble'=> 'required',
            'degradation_rate'=> 'required',
            'crude_protein'=> 'required',
            'metabolizable_protein'=> 'required',
            'calcium'=> 'required',
            'phosphorus'=> 'required',
            'magnesium'=> 'required',
            'potassium'=> 'required',
            'sodium'=> 'required',
            'sulfur'=> 'required',
            'cobalt'=> 'required',
            'copper'=> 'required',
            'iodine'=> 'required',
            'manganese'=> 'required',
            'selenium'=> 'required',
            'zinc' => 'required'
        ]);
        $feeds = Feed::find($id);
        $feeds->update($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $feeds->feed_stuff" ]);
        return redirect()->route('feeds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $feeds = Feed::find($id);

        if(!$feeds->delete()) 
            return redirect()->back();
        
        // handle hapus feeds via ajax
        if ($request->ajax()) 
            return response()->json(['id' => $id]);
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Feeds berhasil dihapus"
        ]);
        return redirect()->route('feeds.index');
    }

    public function generateExcelTemplate() 
    {
        Excel::create('Template Import Feeds', function($excel) 
        { // Set the properties
            $excel->setTitle('Template Import Feeds')
                ->setCreator('Ihsan Arif Rahman')
                ->setCompany('Feedlot')
                ->setDescription('Template import feeds untuk Feedlot');
            $excel->sheet('Data Feeds', function($sheet) { 
            $row = 1;
            $sheet->row($row, [
                'feed_stuff',
                'group_feed_id',
                'dry_matter',
                'mineral',
                'organic_matter',
                'lignin',
                'neutral_detergent_fiber',
                'ether_extract',
                'nonfiber_carbohydrates',
                'total_digestible_nutrients',
                'metabolizable_energy',
                'rumen_undergradable_cp',
                'rumen_undegradable_dm',
                'rumen_degradable_cp',
                'rumen_degradable_dm',
                'rumen_soluble',
                'rumen_insoluble',
                'degradation_rate',
                'crude_protein',
                'metabolizable_protein',
                'calcium',
                'phosphorus',
                'magnesium',
                'potassium',
                'sodium',
                'sulfur',
                'cobalt',
                'copper',
                'iodine',
                'manganese',
                'selenium',
                'zinc'       
                ]); 
            });
        })->export('xlsx');
    }
}
