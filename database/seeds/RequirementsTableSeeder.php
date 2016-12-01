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
        DB::table('requirements')->insert(
        [
            'animal_type' => 'Breeding Heifers',
            'finish' => '454',
            'current'=> '282.388',
            'adg'=>	'0.73',
            'dmi'=> '16.7',
            'nem'=> '50.1',
            'neg'=> '46',
            'cp' => '21',
            'ca' => '7.18',
            'p' => '0.22',
        ]
        );
        	
    }
}
