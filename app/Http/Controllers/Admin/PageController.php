<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PageCreateRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Page;
use Session;
use Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $page = Page::select(['id','title']);
            return Datatables::of($page)
                ->addColumn('action', function($page){
                    return view('admin.datatable._action',[
                        'model' => $page,
                        'edit_url' => route('page.edit',$page->id),
                        'delete_url' => route('page.destroy', $page->id),
                        'confirm_message' => 'Are you sure to delete '. $page->title . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('admin.page.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCreateRequest $request)
    {
        $page = Page::create($request->except('image'));

        if($request->hasFile('image')){
            // Mengambil file yang diupload
            $uploaded_photo = $request->file('image');
            // mengambil extension file
            $extension = $uploaded_photo->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $filename = md5(time()) . '.' . $extension;
            // menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/page/';
            $uploaded_photo->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $page->image = $filename;
            $page->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $page->title"
        ]);
        return redirect('admin/page');
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
        $page = Page::findOrFail($id);
        return view('admin.page.edit')->with(compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $id)
    {
        $page = Page::findOrFail($id);

        if(!$page->update($request->except('image')))
            return redirect()->back();

        if($request->hasFile('image'))
        {
            // menambil cover yang diupload berikut ekstensinya
            $uploaded_photo = $request->file('image');
            $extension = $uploaded_photo->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/page/';
            // memindahkan file ke folder public/img
            $uploaded_photo->move($destinationPath, $filename);
            // hapus cover lama, jika ada
            if ($page->image) 
            {
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/page' . DIRECTORY_SEPARATOR . $page->image;
                try 
                {
                    File::delete($filepath);
                } 
                catch (FileNotFoundException $e) 
                {
                    // File sudah dihapus/tidak ada
                } 
            }
            $page->image = $filename;
            $page->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $page->title"
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $page = Page::findOrFail($id);
        $image = $page->image;

        if(!$page->delete())
            return redirect()->back();
        
        if($image)
        {
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/page' . $page->image;
            try
            {
                File::delete($filepath);
            }
            catch(FileNotFoundException $e)
            {

            }
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berita berhasil dihapus"
        ]);
        return redirect('admin/page');
    }
}
