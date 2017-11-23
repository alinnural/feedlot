<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use Session;
use Validator;

class PostController extends Controller
{
    /**
   * Display a listing of the posts.
   */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $post = Post::select(['id','title','is_draft','published_at']);
            return Datatables::of($post)
                ->addColumn('action', function($post){
                    return view('admin.datatable._action',[
                        'model' => $post,
                        'edit_url' => route('post.edit',$post->id),
                        'delete_url' => route('post.destroy', $post->id),
                        'confirm_message' => 'Are you sure to delete '. $post->title . '?'
                    ]);
                })
                ->addColumn('is_draft',function($post){
                    return $post->is_draft == 0 ? "Active" : "Draft";
                })
                ->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul'])
        ->addColumn(['data' => 'is_draft','name'=>'is_draft','title'=>'Draft','width'=>30])                
        ->addColumn(['data' => 'published_at','name'=>'published_at','title'=>'Terbit','width'=>150])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('admin.post.index')->with(compact('html'));
    }

    /**
    * Show the new post form
    */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
    * Store a newly created Post
    *
    * @param PostCreateRequest $request
    */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());

        if($request->hasFile('page_image')){
            // Mengambil file yang diupload
            $uploaded_photo = $request->file('page_image');
            // mengambil extension file
            $extension = $uploaded_photo->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $filename = md5(time()) . '.' . $extension;
            // menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/post/';
            $uploaded_photo->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $post->page_image = $filename;
            $post->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $post->title"
        ]);
        return redirect('admin/post');
    }

    /**
    * Show the post edit form
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit')->with(compact('post'));
    }

    /**
    * Update the Post
    *
    * @param PostUpdateRequest $request
    * @param int  $id
    */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if(!$post->update($request->all()))
            return redirect()->back();

        if($request->hasFile('page_image'))
        {
            // menambil cover yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('page_image');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/post/';
            // memindahkan file ke folder public/img
            $uploaded_image->move($destinationPath, $filename);
            // hapus cover lama, jika ada
            if ($post->page_image) 
            {
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/post' . DIRECTORY_SEPARATOR . $post->page_image;
                try 
                {
                    File::delete($filepath);
                } 
                catch (FileNotFoundException $e) 
                {
                    // File sudah dihapus/tidak ada
                } 
            }
            $post->page_image = $filename;
            $post->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $post->title"
        ]);

        return redirect()->route('post.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy(Request $request,$id)
    {
        $post = Post::findOrFail($id);
        $page_image = $post->page_image;

        if(!$post->delete())
            return redirect()->back();

        if($request->ajax())
            return response()->json(['id'=>$id]);

        if($page_image)
        {
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/post' . $post->page_image;
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
        return redirect('admin/post');
    }
}
