<?php

use Illuminate\Database\Seeder;
use App\Nutrient;
use App\requirement;

class RequirementNutrientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requirement_nutrients')->insert([
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'1',
            'min_composition'       =>'86',
            'max_composition'       =>'0'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'2',
            'min_composition'       =>'0',
            'max_composition'       =>'0'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'3',
            'min_composition'       =>'13',
            'max_composition'       =>'15'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'4',
            'min_composition'       =>'7',
            'max_composition'       =>'0'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'5',
            'min_composition'       =>'0',
            'max_composition'       =>'0'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'6',
            'min_composition'       =>'0',
            'max_composition'       =>'0'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'7',
            'min_composition'       =>'70',
            'max_composition'       =>'72'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'8',
            'min_composition'       =>'0.80',
            'max_composition'       =>'1.00'
        ],
        [
            'requirement_id'        =>'1',
            'nutrient_id'           =>'9',
            'min_composition'       =>'0.6',
            'max_composition'       =>'0.8'
        ]
        ]);        	
    }
}
