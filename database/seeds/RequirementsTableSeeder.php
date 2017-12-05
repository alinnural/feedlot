<?php

use Illuminate\Database\Seeder;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requirements')->insert([
        ['animal_type'      =>'Sapi Potong Konsentrat Penggemukan','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Potong Konsentrat Induk','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Potong Konsentrat Pejantan','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Starter-1','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Starter-2','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Dara','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Laktasi','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Laktasi Prod Tinggi','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Kering Bunting','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'Sapi Perah Jantan','current_weight'=>'0','average_daily_gain'=>'0'],
        ['animal_type'      =>'New Ransum','current_weight'=>'0','average_daily_gain'=>'0']
        ]);
        	
    }
}
