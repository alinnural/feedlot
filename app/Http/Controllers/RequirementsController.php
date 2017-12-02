<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Requirement;
use App\RequirementNutrient;
use Session;
use Excel;
use Validator;

use App\Http\Requests;
class RequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if($request->ajax())
        {
            $requirements = Requirement::select(['id','animal_type','current_weight','average_daily_gain']);
            return Datatables::of($requirements)
                ->addColumn('action',function($requirements)
                {
                    return view('datatable._action',[
                        'model' => $requirements,
                        'edit_url' => route('requirements.edit',$requirements->id),
                        'delete_url' => route('requirements.destroy', $requirements->id),
                        'confirm_message' => 'Apakah Anda yakin akan menghapus ' . $requirements->animal_type . '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data'=>'animal_type', 'name'=>'animal_type','title'=>'Animal Type'])
            ->addColumn(['data'=>'current_weight', 'name'=>'current_weight','title'=>'Current Body'])
            ->addColumn(['data'=>'average_daily_gain', 'name'=>'average_daily_gain','title'=>'Average Daily Gain'])
            ->addColumn(['data'=>'action','name'=>'action','title'=>'Action','orderable'=>false,'searchable'=>false,'width'=>100]);
        return view('requirements.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requirements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'animal_type'=>'required',
                'current_weight'=> 'required|numeric',
                'average_daily_gain'=> 'required|numeric',
            ]);
        $requirements = Requirement::create($request->all());
        
        $request->session()->flash('flash_notification', [
            'level'=>'success',
            'message' => "Berhasil menyimpan $requirements->animal_type"
        ]);
        return redirect()->route('requirements.index');
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
        $requirements = Requirement::find($id);
        return view('requirements.edit')->with(compact('requirements'));
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
                'animal_type'=>'required',
                'current_weight'=> 'required|numeric',
                'average_daily_gain'=> 'required|numeric',
            ]);
        $requirements = Requirement::find($id);
        $requirements->update($request->all());

        $request->session()->flash('flash_notification', [
            'level'=>'success',
            'message'=>"Berhasil menyimpan $requirements->animal_type"
        ]);
        return redirect()->route('requirements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $requirements = Requirement::find($id);

        if(!$requirements->delete())
            return redirect()->back();

        if($request->ajax())
            return response()->json(['id'=>$id]);
        
        $request->session()->flash('flash_notification', [
            'level'=>'success',
            'message'=>"Requirement berhasil dihapus"
        ]);
        return redirect()->route('requirements.index');
    }

    public function generateExcelTemplate()
    {
        Excel::create('Template Import Requirement', function($excel) 
        { // Set the properties
            $excel->setTitle('Template Import Requirement')
                ->setCreator('Ihsan Arif Rahman')
                ->setCompany('Feedlot')
                ->setDescription('Template import Requirement untuk Feedlot');
            $excel->sheet('Data Requirement', function($sheet) { 
            $row = 1;
            $sheet->row($row, [
                'animal_type',
                'finish',
                'current',
                'adg',
                'dmi',
                'tdn',
                'nem',
                'neg',
                'cp',
                'ca',
                'p',
                'month_pregnant',
                'month_calvin',
                'peak_milk',
                'current_milk',     
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
            'animal_type'=>'required',
            'finish'=> 'required',
            'current'=> 'required',
            'adg'=> 'required',
            'dmi'=> 'required',
            'tdn'=> 'required',
            'nem'=> 'required',
            'neg'=> 'required',
            'cp'=> 'required',
            'ca'=> 'required',
            'p'=> 'required',
            'month_pregnant'=> 'required',
            'month_calvin'=> 'required',
            'peak_milk'=> 'required',
            'current_milk'=> 'required',
        ];
        // Catat semua id feeds baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $requiremnet_id = [];
        $error = [];
        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);
            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;
            
            // buat feeds baru
            try
            {
                $requirements = Requirement::create([
                    'animal_type' => $row['animal_type'],
                    'finish' => $row['finish'],
                    'current' => $row['current'],
                    'adg' => $row['adg'],
                    'dmi' => $row['dmi'],
                    'tdn' => $row['tdn'],
                    'nem' => $row['nem'],
                    'neg' => $row['neg'],
                    'cp' => $row['cp'],
                    'ca' => $row['ca'],
                    'p' => $row['p'],
                    'month_pregnant' => $row['month_pregnant'],
                    'month_calvin' => $row['month_calvin'],
                    'peak_milk' => $row['peak_milk'],
                    'current_milk' => $row['current_milk'],
                ]);
            }
            catch(Exception $e)
            {
                array_push($error,"error". $row['animal_type'] ." ". $e . " ". $validator->errors()->all);
            }
            
            // catat id dari buku yang baru dibuat
            array_push($requiremnet_id, $requirements->id);
        }
       
        // Ambil semua buku yang baru dibuat
        $requirements = Requirement::whereIn('id', $requiremnet_id)->get();
        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($requirements->count() == 0) 
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
            "message" => "Berhasil mengimport " . $requirements->count() . " requirement."
        ]);
        // Tampilkan halaman review buku
        return redirect()->route('requirements.index');
    }

    public function AjaxSearch(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }

        $requirements = Requirement::SearchByKeyword($term)->get();

        $formatted_requirements = [];
        foreach ($requirements as $requirement) {
            $formatted_requirements[] = ['id' => $requirement->id, 'text' => $requirement->animal_type." (Finish Weight = $requirement->finish"." Current Weight= $requirement->current)"];
        }

        return \Response::json($formatted_requirements);
    }

    public function AjaxFind(Request $request)
    {
        if(empty($request->req_id))
        {
            $data = array();
            return \Response::json($data);
        }
        else
        {
            $request->session()->put('req_id', $request->req_id);

            $reqnuts = RequirementNutrient::SearchNutrient(1)->get();
            
            if(empty($reqnuts))
            {
                $request->session()->put('requirement_id',0);
            }
            else
            {
                $request->session()->put('requirement_id',$request->req_id);
            }
            
            foreach($reqnuts as $rn){
                $result[] = ['name' => $rn->nutrient->name, 'min' => $rn->min_composition, 'max' => $rn->max_composition];
            }
            print_r($result);exit;
            return \Response::json($result);
        }
    }
}
