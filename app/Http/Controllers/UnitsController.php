<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Session;
use Validator;
use Yajra\Datatables\Html\Builder; 
use Yajra\Datatables\Datatables;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $group = Unit::select(['id', 'name', 'symbol']);
            return Datatables::of($group)
                ->addColumn('action', function($group){
                    return view('datatable._action',[
                        'model' => $group,
                        'edit_url' => route('units.edit',$group->id),
                        'delete_url' => route('units.destroy', $group->id),
                        'confirm_message' => 'Apakah Anda yakin akan menghapus '. $group->name . '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'symbol', 'name'=>'symbol', 'title'=>'Simbol'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('units.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:units','symbol' => '']); 
        $group = Unit::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $group->name"
        ]);
        return redirect()->route('units.index');
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
        $group = Unit::find($id);
        return view('units.edit')->with(compact('group'));
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
        $this->validate($request, ['name' => 'required|unique:units,name,'. $id]);
        $group = Unit::find($id);
        $group->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $group->name" ]);
        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Unit::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Units berhasil dihapus"
        ]);
        return redirect()->route('units.index');
    }
}
