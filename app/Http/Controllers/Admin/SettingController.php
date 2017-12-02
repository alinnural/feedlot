<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SettingCreateRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Setting;
use Session;
use Validator;
use App\Config;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $setting = Setting::select(['id','name','code','value']);
            return Datatables::of($setting)
                ->addColumn('action', function($setting){
                    return view('admin.setting._action',[
                        'model' => $setting,
                        'edit_url' => route('setting.edit',$setting->id),
                        'confirm_message' => 'Are you sure to delete '. $setting->name . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'code', 'name'=>'code', 'title'=>'Kode'])
        ->addColumn(['data' => 'value', 'name'=>'value', 'title'=>'Isi'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.setting.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingCreateRequest $request)
    {
        $setting = Setting::create($request->all());

         Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $setting->name"
        ]);
        return redirect('admin/setting');
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
        $setting = Setting::findOrFail($id);
        return view('admin.setting.edit')->with(compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, $id)
    {
        $setting = Setting::findOrFail($id);

        if(!$setting->update($request->all()))
            return redirect()->back();
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $setting->name"
        ]);

        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $name = $setting->name;

        if(!$setting->delete())
            return redirect()->back();
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Setting $name berhasil dihapus"
        ]);
        return redirect('admin/setting');
    }
}
