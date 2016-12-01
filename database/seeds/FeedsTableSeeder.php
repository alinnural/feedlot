<?php

use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feeds')->insert(
        [
            'feed_stuff'    =>'Alfalfa Cubes',	
            'energy_dm'     =>'91',
            'energy_tdn'	=>'57',
            'energy_nem'	=>'57',
            'energy_neg'    =>'25',
            'energy_nel'	=>'57',
            'protein_cp'	=>'18',
            'protein_uip'	=>'30',
            'protein_npn'	=>'0',
            'fiber_cf'	    =>'29',
            'fiber_adf'	    =>'36',
            'fiber_ndf'	    =>'46',
            'fiber_endf'	=>'40',
            'ee'	        =>'2',
            'ash'	        =>'11',
            'ca'	        =>'1.30',
            'p'	            =>'0.23',
            'k'	            =>'1.9',
            'cl'	        =>'0.37',
            's'	            =>'0.33',
            'zn'            =>'20',
        ]
        );
    }
}
