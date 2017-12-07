<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use Session;
use Validator;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AlbumCreateRequest;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('Photos')->paginate(10);
        return view('admin.album.index')
        ->with('albums',$albums);
    }

    public function show($id)
    {
        $album = Album::with('Photos')->find($id);
        $albums = Album::all();
        return view('admin.album.album')
        ->with('album',$album)
        ->with('albums',$albums);
    }
    
    public function create()
    {
        return view('admin.album.create');
    }

    public function store(AlbumCreateRequest $request)
    {
        $album = Album::create($request->except('cover_image'));

        if($request->hasFile('cover_image'))
        {
            $uploaded_photo = $request->file('cover_image');
            $extension = $uploaded_photo->getClientOriginalExtension();
            
            $random_name = str_random(8);
            $filename= $random_name.'_cover.'.$extension;
            $destinationPath = public_path().DIRECTORY_SEPARATOR. 'img/cover/';
            $uploaded_photo->move($destinationPath,$filename);

            $album->cover_image = $filename;
            $album->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $album->name"
        ]);

        // return redirect('album.show',array('id'=>$album->id));
        return redirect('admin/album/'.$album->id);
    }

    public function destroy($id)
    {
        $album = Album::find($id);

        $album->delete();

        return redirect('admin/album');
    }
}
