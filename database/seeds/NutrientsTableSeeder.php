<?php

use Illuminate\Database\Seeder;
use App\Nutrients;

class NutrientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nutrients')->insert([
        [
            'name'              =>'Bahan Kering',	
            'abbreviation'      =>'BK',
            'unit_id'           =>'1'
        ],
        [
            'name'              =>'Abu',	
            'abbreviation'      =>'Abu',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'Protein Kasar',	
            'abbreviation'      =>'PK',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'Lemak Kasar',	
            'abbreviation'      =>'LK',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'Serat Kasar',	
            'abbreviation'      =>'SK',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'BetaN',	
            'abbreviation'      =>'BetaN',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'TDN',	
            'abbreviation'      =>'TDN',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'Kalsium',	
            'abbreviation'      =>'Ca',
            'unit_id'           => '1'
        ],
        [
            'name'              =>'Pospor',	
            'abbreviation'      =>'P',
            'unit_id'           => '1'
        ]
        ]);
    }
}
