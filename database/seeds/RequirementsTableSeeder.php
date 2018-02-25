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
        ['animal_type'      =>'Sapi Potong Konsentrat Penggemukan'],
        ['animal_type'      =>'Sapi Potong Konsentrat Induk'],
        ['animal_type'      =>'Sapi Potong Konsentrat Pejantan'],
        ['animal_type'      =>'Sapi Perah Starter-1'],
        ['animal_type'      =>'Sapi Perah Starter-2'],
        ['animal_type'      =>'Sapi Perah Dara'],
        ['animal_type'      =>'Sapi Perah Laktasi'],
        ['animal_type'      =>'Sapi Perah Laktasi Prod Tinggi'],
        ['animal_type'      =>'Sapi Perah Kering Bunting'],
        ['animal_type'      =>'Sapi Perah Jantan'],
        ['animal_type'      =>'New Ransum']
        ]);
        	
    }
}
