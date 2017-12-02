<?php

use Illuminate\Database\Seeder;
use App\Setting;
use Carbon\Carbon;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting1 = new Setting();
        $setting1->name = "Nama Website";
        $setting1->code = "site_name";
        $setting1->value = "Formula Ransum Ternak Ruminansia";
        $setting1->save();

        $setting4 = new Setting();
        $setting4->name = "Deskripsi Website";
        $setting4->code = "site_description";
        $setting4->value = "Formula Ransum Ternak Ruminansia";
        $setting4->save();

        $setting2 = new Setting();
        $setting2->name = "Jumlah Artikel Per Halaman";
        $setting2->code = "paging_news";
        $setting2->value = "6";
        $setting2->save();

        $setting3 = new Setting();
        $setting3->name = "Jumlah Slider Yang Akan Ditampilkan";
        $setting3->code = "paging_slider";
        $setting3->value = "4";
        $setting3->save();
    }
}
