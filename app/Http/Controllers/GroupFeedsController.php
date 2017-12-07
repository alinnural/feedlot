<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupFeed;
use Session;
use Yajra\Datatables\Html\Builder; 
use Yajra\Datatables\Datatables;



class GroupFeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $group = GroupFeed::select(['id', 'name']);
            return Datatables::of($group)
                ->addColumn('action', function($group){
                    return view('datatable._action',[
                        'model' => $group,
                        'edit_url' => route('groupfeeds.edit',$group->id),
                        'delete_url' => route('groupfeeds.destroy', $group->id),
                        'confirm_message' => 'Apakah Anda yakin akan menghapus '. $group->name . '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('groupfeeds.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groupfeeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:group_feeds']); 
        $group = GroupFeed::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $group->name"
        ]);
        return redirect()->route('groupfeeds.index');
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
        $group = GroupFeed::find($id);
        return view('groupfeeds.edit')->with(compact('group'));
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
        $this->validate($request, ['name' => 'required|unique:group_feeds,name,'. $id]);
        $group = GroupFeed::find($id);
        $group->update($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $group->name" ]);
        return redirect()->route('groupfeeds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!GroupFeed::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Kelompok pakan sapi berhasil dihapus"
        ]);
        return redirect()->route('groupfeeds.index');
    }
}
