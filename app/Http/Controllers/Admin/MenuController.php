<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\MenuCreateRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Menu;
use Session;
use Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $menu = menu::select(['id','name','is_parent','parent_id','type','position']);
            return Datatables::of($menu)
                ->addColumn('action', function($menu){
                    return view('admin.menu._action',[
                        'model' => $menu,
                        'delete_url' => route('menu.destroy', $menu->id),
                        'confirm_message' => 'Are you sure to delete '. $menu->title . '?'
                    ]);
                })
                ->addColumn('type',function ($menu) {
                    if ($menu->type == 1) return 'Link';
                    if ($menu->type == 2) return 'Halaman';
                    return '0';
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'is_parent', 'name'=>'is_parent', 'title'=>'Root'])
        ->addColumn(['data' => 'position', 'name'=>'position', 'title'=>'Posisi'])
        ->addColumn(['data' => 'type', 'name'=>'type', 'title'=>'Tipe'])        
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('admin.menu.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(menuCreateRequest $request)
    {
        $menu = Menu::create($request->postFillData());
        // print_r($request->postFillData());
        // die();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $menu->name"
        ]);
        return redirect('admin/menu');
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
        $menu = menu::findOrFail($id);
        return view('admin.menu.edit')->with(compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(menuUpdateRequest $request, $id)
    {
        $menu = menu::findOrFail($id);

        if(!$menu->update($request->all()))
            return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $menu->title"
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $menu = menu::findOrFail($id);

        if(!$menu->delete())
            return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berita berhasil dihapus"
        ]);
        return redirect('admin/menu');
    }
}
