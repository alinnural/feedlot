<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\File as FileDatabase;
use Session;
use Validator;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request, Builder $htmlBuilder)
     {
         if ($request->ajax()) {
             $file = FileDatabase::select(['id','name','extension','is_public']);
             return Datatables::of($file)
                ->addColumn('name',function($file) {
                    return "<a href=".route('file.show',$file->id).">".$file->name."</a>";
                })
                ->addColumn('is_public', function($file) {
                    return $file->is_public == 1 ? "Ya" : "Tidak";
                })
                ->addColumn('action', function($file){
                     return view('admin.file._action',[
                         'model' => $file,
                         'edit_url' => route('file.edit',$file->id),
                         'delete_url' => route('file.destroy', $file->id),
                         'confirm_message' => 'Are you sure to delete '. $file->name . '?'
                     ]);
             })->make(true);
         }
         $html = $htmlBuilder
         ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama File'])
         ->addColumn(['data' => 'extension', 'name'=>'extension', 'title'=>'Ekstensi'])
         ->addColumn(['data' => 'is_public', 'name'=>'is_public', 'title'=>'Public'])
         ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
         return view('admin.file.index')->with(compact('html'));
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('admin.file.create');
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
            'name'=> 'required|unique:files,name',
            'is_public' => 'required',
            'file' => 'required|file|max:5000'
        ]);
        
         $file = FileDatabase::create($request->except('file'));
 
         if($request->hasFile('file')){
             // Mengambil file yang diupload
             $uploaded = $request->file('file');
             // mengambil extension file
             $extension = $uploaded->getClientOriginalExtension();
             // membuat nama file random berikut extension
             $filename = $uploaded->getClientOriginalName();
             // menyimpan cover ke folder public/img
             $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'file/';
             $uploaded->move($destinationPath, $filename);
             // mengisi field cover di book dengan filename yang baru dibuat
             $file->file = $filename;
             $file->extension = $extension;
             $file->save();
         }
         Session::flash("flash_notification", [
             "level"=>"success",
             "message"=>"Berhasil menyimpan $file->name"
         ]);
         return redirect('admin/file');
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         $file = FileDatabase::find($id);
         return view('admin.file.show')
                    ->with(compact('file'));
     }

     public function edit($id)
     {

     }

     public function update(Request $id)
     {

     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Request $request,$id)
     {
         $file = FileDatabase::findOrFail($id);
         $filenya = $file->file;
 
         if(!$file->delete())
             return redirect()->back();
         
         if($filenya){
             $filepath = public_path() . DIRECTORY_SEPARATOR . 'file' . $file->file;
             try{
                File::delete($filepath);
             }catch(FileNotFoundException $e)
             { }
         }
 
         Session::flash("flash_notification", [
             "level"=>"success",
             "message"=>"Berita berhasil dihapus"
         ]);
         return redirect('admin/file');
     }
}
