<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use App\Image;
use Session;
use Validator;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;

class ImageController extends Controller
{
    public function create($id)
    {
        $album = Album::find($id);
        return view('admin.image.create')
        ->with('album',$album);
    }

    public function store(ImageCreateRequest $request)
    {
        $image = Image::create($request->except('image'));
        $album_id = $request->input('album_id');

        if($request->hasFile('image'))
        {
            $uploaded_photo = $request->file('image');
            $extension = $uploaded_photo->getClientOriginalExtension();
            
            $random_name = str_random(8);
            $filename= $random_name.'_album_image.'.$extension;
            $destinationPath = public_path().DIRECTORY_SEPARATOR. 'img/album/';
            $uploaded_photo->move($destinationPath,$filename);

            $image->image = $filename;
            $image->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $image->image"
        ]);

        // return redirect('album/show',array('id'=>$album_id));
        return redirect('admin/album/'. $album_id);
    }
    
    public function destroy(Request $request,$id)
    {
        $image = Image::findOrFail($id);
       if(!$image->delete())
            return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menghapus $image->image"
        ]);

        return redirect('admin/album/'. $image->album_id);
    }

    public function move(ImageUpdateRequest $request, $id)
    {
        // print_r($request->all());
        // echo $id;
        // die();
        $image = Image::findOrFail($id);
        $image->album_id = $request->input('album_id');
        $image->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil memindahkan $image->image"
        ]);

        return redirect('admin/album/'.$request->input('new_album'));
    }
}
