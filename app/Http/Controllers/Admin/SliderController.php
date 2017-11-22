<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderCreateRequest;
use App\Slider;
use Validator;
use Session;


class SliderController extends Controller
{
    // source : http://the-amazing-php.blogspot.co.id/2015/06/laravel-5.1-image-gallery-crud.html
    public function index()
    {
        $slider = Slider::paginate(10);
        return view('admin.slider.images-list')->with('slider', $slider);
    }

    public function create()
    {
        return view('admin.slider.add-new-image');
    }

    public function show($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.image-detail')->with('slider', $slider);
    }

    

    public function store(SliderCreateRequest $request)
    {
        $slider = Slider::create($request->postFillData());
        
        if($request->hasFile('photo')){
            // Mengambil file yang diupload
            $uploaded_photo = $request->file('photo');
            // membuat nama file random berikut extension
            $filename = str_random(6).'_'.$uploaded_photo->getClientOriginalName();
            // menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/slider/';
            $uploaded_photo->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $slider->photo = $filename;
            $slider->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $slider->name"
        ]);

        return redirect('admin/slider');
    }

   public function destroy($id)
   {
      $image = Slider::find($id);
      $name = $image->name;
      $image->delete();

      Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil dihapus slider $name"
        ]);

      return redirect('admin/slider');
   }
}
