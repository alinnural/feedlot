<?php

use Illuminate\Database\Seeder;
use App\Slider;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider1 = new Slider();
        $slider1->name = "Sapi perah penghasil susu";
        $slider1->photo = "slider-1.jpg";
        $slider1->is_active = 1;
        $slider1->save();

        $slider2 = new Slider();
        $slider2->name = "Surgom";
        $slider2->photo = "slider-2.jpg";
        $slider2->is_active = 1;
        $slider2->save();

        $slider3 = new Slider();
        $slider3->name = "Jagung Kuning";
        $slider3->photo = "slider-3.jpg";
        $slider3->is_active = 1;
        $slider3->save();

        $slider4 = new Slider();
        $slider4->name = "Rumput Gajah";
        $slider4->photo = "slider-4.jpg";
        $slider4->is_active = 1;
        $slider4->save();
    }
}
