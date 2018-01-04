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

class RequirementNutrientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $requirementnutrients = RequirementNutrient::with('requirement','nutrient');
            return Datatables::of($requirementnutrients)
                ->addColumn('action', function($requirementnutrient){
                    return view('datatable._action',[
                        'model' => $requirementnutrient,
                        'edit_url' => route('requirementnutrients.edit',$requirementnutrient->id),
                        'delete_url' => route('requirementnutrients.destroy', $requirementnutrient->id),
                        'confirm_message' => 'Apakah Anda yakin akan menghapus pakan '. $requirementnutrient->requirement->name .' dengan nutrien '. $requirementnutrient->nutrient->name .' ?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'requirement.name', 'name'=>'requirement.name', 'title'=>'Requirements'])
        ->addColumn(['data' => 'nutrient.name', 'name'=>'nutrient.name', 'title'=>'Nutrien'])
        ->addColumn(['data' => 'min_composition', 'name'=>'min_composition', 'title'=>'Minimum Komposisi'])
        ->addColumn(['data' => 'max_composition', 'name'=>'max_composition', 'title'=>'Maksimum Komposisi'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('requirementnutrients.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $requirement = Requirement::find($id);
        return view('requirementnutrients.create')
                    ->with(compact('requirement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nutrient_id'=> 'required',
            'requirement_id' => 'required',
            'min_composition' => 'required',
            'max_composition' => 'required'
        ]);
        $requirementnutrients = RequirementNutrient::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan nutrien ternak"
        ]);
        return redirect()->route('requirements.show',$request->requirement_id);
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
        $requirementnutrients = RequirementNutrient::find($id);
        $requirement = Requirement::find($requirementnutrients->requirement_id);
        return view('requirementnutrients.edit')
                    ->with(compact('requirementnutrients'))
                    ->with(compact('requirement'));
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
            'nutrient_id'=> 'required',
            'requirement_id' => 'required',
            'min_composition' => 'required',
            'max_composition' => 'required'
        ]);
        $requirementnutrients = RequirementNutrient::find($id);
        $requirementnutrients->update($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil mengubah nutrien ternak" ]);
        return redirect()->route('requirements.show',$request->requirement_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $req_id = RequirementNutrient::find($id)->requirement_id;
        if(!RequirementNutrient::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Nutrien Ternak berhasil dihapus"
        ]);
        return redirect()->route('requirements.show',$req_id);
    }

    public function generateExcelTemplate() 
    {
        Excel::create('Template Import Requirements', function($excel) 
        { // Set the properties
            $excel->setTitle('Template Import Requirements')
                ->setCreator('Ihsan Arif Rahman')
                ->setCompany('Requirementlot')
                ->setDescription('Template import requirements untuk Requirementlot');
            $excel->sheet('Data Requirements', function($sheet) { 
            $row = 1;
            $sheet->row($row, [
                'requirement_stuff',
                'group_requirement_id',
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
            'requirement_stuff'=> 'required',
            'group_requirement_id' => 'required'
        ];
        // Catat semua id requirements baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $requirements_id = [];
        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);
            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;
            // check data group requirement
            $group_requirements = GroupRequirement::where('name', $row['group_requirement_id'])->first();
            // buat penulis jika belum ada
            if (!$group_requirements) 
            {
                $group_requirements = GroupRequirement::create(['name'=>$row['group_requirement_id']]);
            }
            // buat requirements baru
            $requirement = Requirement::create([
                'requirement_stuff'=> $row['requirement_stuff'],
                'group_requirement_id' => $group_requirements->id,
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
            array_push($requirements_id, $requirement->id);
        }
        
        // Ambil semua buku yang baru dibuat
        $requirement = Requirement::whereIn('id', $requirements_id)->get();
        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($requirement->count() == 0) 
        {
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => "Tidak ada pakan yang berhasil diimport."
            ]);
            return redirect()->back();
        }
        // set requirementback
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil mengimport " . $requirement->count() . " pakan."
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
            $formatted_requirements[] = ['id' => $requirement->id, 'text' => $requirement->requirement_stuff ];
        }

        return \Response::json($formatted_requirements);
    }
}
