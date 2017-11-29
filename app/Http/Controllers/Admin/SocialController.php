<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

use App\Http\Requests\SocialCreateRequest;
use App\Http\Requests\SocialUpdateRequest;
use App\Social;
use Session;
use Validator;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $social = Social::select(['id','name','icon','order']);
            return Datatables::of($social)
                ->addColumn('action', function($social){
                    return view('admin.datatable._action',[
                        'model' => $social,
                        'edit_url' => route('social.edit',$social->id),
                        'delete_url' => route('social.destroy', $social->id),
                        'confirm_message' => 'Are you sure to delete '. $social->name . '?'
                    ]);
                })
                ->addColumn('icon', function($social){
                    return view('admin.social._icon',[
                        'icon' => $social->icon
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'icon','name'=>'icon','title'=>'Icon'])
        ->addColumn(['data' => 'order','name'=>'order','title'=>'Order'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('admin.social.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.social.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(socialCreateRequest $request)
    {
        $social = Social::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $social->name"
        ]);
        return redirect('admin/social');
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
        $social = Social::findOrFail($id);
        return view('admin.social.edit')->with(compact('social'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialUpdateRequest $request, $id)
    {
        $social = Social::findOrFail($id);

        if(!$social->update($request->all()))
            return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $social->name"
        ]);

        return redirect()->route('social.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $social = Social::findOrFail($id);

        if(!$social->delete())
            return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berita berhasil dihapus"
        ]);
        return redirect('admin/social');
    }
}
