<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Feed;
use App\GroupFeed;
use Session;
use Excel;
use Validator;

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
            'dry_matter' => 'required|numeric',
            'mineral' => 'required|numeric',
            'organic_matter'=> 'required|numeric',
            'lignin'=> 'required|numeric',
            'neutral_detergent_fiber'=> 'required|numeric',
            'ether_extract'=> 'required|numeric',
            'nonfiber_carbohydrates'=> 'required|numeric',
            'total_digestible_nutrients'=> 'required|numeric',
            'metabolizable_energy'=> 'required|numeric',
            'rumen_undergradable_cp'=> 'required|numeric',
            'rumen_undergradable_dm'=> 'required|numeric',
            'rumen_degradable_cp'=> 'required|numeric',
            'rumen_degradable_dm'=> 'required|numeric',
            'rumen_soluble'=> 'required|numeric',
            'rumen_insoluble'=> 'required|numeric',
            'degradation_rate'=> 'required|numeric',
            'crude_protein'=> 'required|numeric',
            'metabolizable_protein'=> 'required|numeric',
            'calcium'=> 'required|numeric',
            'phosphorus'=> 'required|numeric',
            'magnesium'=> 'required|numeric',
            'potassium'=> 'required|numeric',
            'sodium'=> 'required|numeric',
            'sulfur'=> 'required|numeric',
            'cobalt'=> 'required|numeric',
            'copper'=> 'required|numeric',
            'iodine'=> 'required|numeric',
            'manganese'=> 'required|numeric',
            'selenium'=> 'required|numeric',
            'zinc' => 'required|numeric'
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
            'dry_matter' => 'required|numeric',
            'mineral' => 'required|numeric',
            'organic_matter'=> 'required|numeric',
            'lignin'=> 'required|numeric',
            'neutral_detergent_fiber'=> 'required|numeric',
            'ether_extract'=> 'required|numeric',
            'nonfiber_carbohydrates'=> 'required|numeric',
            'total_digestible_nutrients'=> 'required|numeric',
            'metabolizable_energy'=> 'required|numeric',
            'rumen_undergradable_cp'=> 'required|numeric',
            'rumen_undergradable_dm'=> 'required|numeric',
            'rumen_degradable_cp'=> 'required|numeric',
            'rumen_degradable_dm'=> 'required|numeric',
            'rumen_soluble'=> 'required|numeric',
            'rumen_insoluble'=> 'required|numeric',
            'degradation_rate'=> 'required|numeric',
            'crude_protein'=> 'required|numeric',
            'metabolizable_protein'=> 'required|numeric',
            'calcium'=> 'required|numeric',
            'phosphorus'=> 'required|numeric',
            'magnesium'=> 'required|numeric',
            'potassium'=> 'required|numeric',
            'sodium'=> 'required|numeric',
            'sulfur'=> 'required|numeric',
            'cobalt'=> 'required|numeric',
            'copper'=> 'required|numeric',
            'iodine'=> 'required|numeric',
            'manganese'=> 'required|numeric',
            'selenium'=> 'required|numeric',
            'zinc' => 'required|numeric'
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
                'rumen_undergradable_dm',
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

    public function importExcel(Request $request) 
    {
         // validasi untuk memastikan file yang diupload adalah excel
        $this->validate($request, [ 'excel' => 'required|mimes:xls,xlsx' ]);
        // ambil file yang baru diupload
        $excel = $request->file('excel');
        // baca sheet pertama
        $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader) {
            // options, jika ada
        })->get();
        // rule untuk validasi setiap row pada file excel
        $rowRules = [
            'feed_stuff'=> 'required',
            'group_feed_id' => 'required'
        ];
        // Catat semua id feeds baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $feeds_id = [];
        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);
            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;
            // check data group feed
            $group_feeds = GroupFeed::where('name', $row['group_feed_id'])->first();
            // buat penulis jika belum ada
            if (!$group_feeds) 
            {
                $group_feeds = GroupFeed::create(['name'=>$row['group_feed_id']]);
            }
            // buat feeds baru
            $feed = Feed::create([
                'feed_stuff'=> $row['feed_stuff'],
                'group_feed_id' => $group_feeds->id,
                'dry_matter' => $row['dry_matter'],
                'mineral' => $row['mineral'],
                'organic_matter'=> $row['organic_matter'],
                'lignin'=> $row['lignin'],
                'neutral_detergent_fiber'=> $row['neutral_detergent_fiber'],
                'ether_extract'=> $row['ether_extract'],
                'nonfiber_carbohydrates'=> $row['nonfiber_carbohydrates'],
                'total_digestible_nutrients'=> $row['total_digestible_nutrients'],
                'metabolizable_energy'=> $row['metabolizable_energy'],
                'rumen_undergradable_cp'=> $row['rumen_undergradable_cp'],
                'rumen_undergradable_dm'=> $row['rumen_undergradable_dm'],
                'rumen_degradable_cp'=> $row['rumen_degradable_cp'],
                'rumen_degradable_dm'=> $row['rumen_degradable_dm'],
                'rumen_soluble'=> $row['rumen_soluble'],
                'rumen_insoluble'=> $row['rumen_insoluble'],
                'degradation_rate'=> $row['degradation_rate'],
                'crude_protein'=> $row['crude_protein'],
                'metabolizable_protein'=> $row['metabolizable_protein'],
                'calcium'=> $row['calcium'],
                'phosphorus'=> $row['phosphorus'],
                'magnesium'=> $row['magnesium'],
                'potassium'=> $row['potassium'],
                'sodium'=> $row['sodium'],
                'sulfur'=> $row['sulfur'],
                'cobalt'=> $row['cobalt'],
                'copper'=> $row['copper'],
                'iodine'=> $row['iodine'],
                'manganese'=> $row['manganese'],
                'selenium'=> $row['selenium'],
                'zinc' => $row['zinc']
            ]);
            
            // catat id dari buku yang baru dibuat
            array_push($feeds_id, $feed->id);
        }
        
        // Ambil semua buku yang baru dibuat
        $feed = Feed::whereIn('id', $feeds_id)->get();
        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($feed->count() == 0) 
        {
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => "Tidak ada pakan yang berhasil diimport."
            ]);
            return redirect()->back();
        }
        // set feedback
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil mengimport " . $feed->count() . " pakan."
        ]);
        // Tampilkan halaman review buku
        return redirect()->route('feeds.index');
    }

    public function AjaxSearch(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }

        $feeds = Feed::SearchByKeyword($term)->get();

        $formatted_feeds = [];
        foreach ($feeds as $feed) {
            $formatted_feeds[] = ['id' => $feed->id, 'text' => $feed->feed_stuff ];
        }

        return \Response::json($formatted_feeds);
    }
}
