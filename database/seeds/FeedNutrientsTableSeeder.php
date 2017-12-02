<?php

use Illuminate\Database\Seeder;
use App\FeedNutrients;

class FeedNutrientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feed_nutrients')->insert([
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'1',
            'composition'           =>'86.8'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'2',
            'composition'           =>'2.2'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'3',
            'composition'           =>'10.8'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'4',
            'composition'           =>'4.28'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'5',
            'composition'           =>'3.5'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'6',
            'composition'           =>'80.2'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'7',
            'composition'           =>'80.8'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'8',
            'composition'           =>'0.234'
        ],
        [
            'feed_id'               =>'7',
            'nutrient_id'           =>'9',
            'composition'           =>'0.414'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'1',
            'composition'           =>'87.7'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'2',
            'composition'           =>'13.6'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'3',
            'composition'           =>'12.00'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'4',
            'composition'           =>'8.64'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'5',
            'composition'           =>'13.9'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'6',
            'composition'           =>'50.9'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'7',
            'composition'           =>'67.9'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'8',
            'composition'           =>'0.086'
        ],
        [
            'feed_id'               =>'10',
            'nutrient_id'           =>'9',
            'composition'           =>'1.390'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'1',
            'composition'           =>'79.8'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'2',
            'composition'           =>'2.4'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'3',
            'composition'           =>'1.87'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'4',
            'composition'           =>'0.32'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'5',
            'composition'           =>'8.9'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'6',
            'composition'           =>'86.5'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'7',
            'composition'           =>'78.3'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'8',
            'composition'           =>'0.26'
        ],
        [
            'feed_id'               =>'8',
            'nutrient_id'           =>'9',
            'composition'           =>'0.16'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'1',
            'composition'           =>'90.3'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'2',
            'composition'           =>'4.1'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'3',
            'composition'           =>'16.80'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'4',
            'composition'           =>'11.90'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'5',
            'composition'           =>'22.6'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'6',
            'composition'           =>'44.6'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'7',
            'composition'           =>'79'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'8',
            'composition'           =>'0.165'
        ],
        [
            'feed_id'               =>'13',
            'nutrient_id'           =>'9',
            'composition'           =>'0.616'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'1',
            'composition'           =>'88.6'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'2',
            'composition'           =>'8.2'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'3',
            'composition'           =>'21.30'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'4',
            'composition'           =>'10.90'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'5',
            'composition'           =>'14.2'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'6',
            'composition'           =>'45.4'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'7',
            'composition'           =>'78.7'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'8',
            'composition'           =>'0.165'
        ],
        [
            'feed_id'               =>'14',
            'nutrient_id'           =>'9',
            'composition'           =>'0.616'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'1',
            'composition'           =>'70.9'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'2',
            'composition'           =>'4'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'3',
            'composition'           =>'4'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'4',
            'composition'           =>'0.10'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'5',
            'composition'           =>'1.00'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'6',
            'composition'           =>'90.90'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'7',
            'composition'           =>'80.0'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'8',
            'composition'           =>'0.8'
        ],
        [
            'feed_id'               =>'9',
            'nutrient_id'           =>'9',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'1',
            'composition'           =>'99'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'2',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'3',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'4',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'5',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'6',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'7',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'8',
            'composition'           =>'38'
        ],
        [
            'feed_id'               =>'16',
            'nutrient_id'           =>'9',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'1',
            'composition'           =>'26.6'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'2',
            'composition'           =>'14.2'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'3',
            'composition'           =>'23.50'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'4',
            'composition'           =>'24.20'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'5',
            'composition'           =>'16'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'6',
            'composition'           =>'22.1'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'7',
            'composition'           =>'87.2'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'8',
            'composition'           =>'0.882'
        ],
        [
            'feed_id'               =>'15',
            'nutrient_id'           =>'9',
            'composition'           =>'0.141'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'1',
            'composition'           =>'89.5'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'2',
            'composition'           =>'7.7'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'3',
            'composition'           =>'41.2'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'4',
            'composition'           =>'17.6'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'5',
            'composition'           =>'7.9'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'6',
            'composition'           =>'25.6'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'7',
            'composition'           =>'92.8'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'8',
            'composition'           =>'0.39'
        ],
        [
            'feed_id'               =>'12',
            'nutrient_id'           =>'9',
            'composition'           =>'0.839'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'1',
            'composition'           =>'99.6'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'2',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'3',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'4',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'5',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'6',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'7',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'8',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'18',
            'nutrient_id'           =>'9',
            'composition'           =>'0'
        ],
        [
            'feed_id'               =>'3',
            'nutrient_id'           =>'1',
            'composition'           =>'22.2'
        ],
        [
            'feed_id'               =>'3',
            'nutrient_id'           =>'7',
            'composition'           =>'52.4'
        ],
        [
            'feed_id'               =>'3',
            'nutrient_id'           =>'3',
            'composition'           =>'8.69'
        ],
        [
            'feed_id'               =>'3',
            'nutrient_id'           =>'8',
            'composition'           =>'0.475'
        ],
        [
            'feed_id'               =>'3',
            'nutrient_id'           =>'9',
            'composition'           =>'0.347'
        ],
        [
            'feed_id'               =>'1',
            'nutrient_id'           =>'1',
            'composition'           =>'87.5'
        ],
        [
            'feed_id'               =>'1',
            'nutrient_id'           =>'7',
            'composition'           =>'43.2'
        ],
        [
            'feed_id'               =>'1',
            'nutrient_id'           =>'3',
            'composition'           =>'4.15'
        ],
        [
            'feed_id'               =>'1',
            'nutrient_id'           =>'8',
            'composition'           =>'0.413'
        ],
        [
            'feed_id'               =>'1',
            'nutrient_id'           =>'9',
            'composition'           =>'0.292'
        ],
        [
            'feed_id'               =>'19',
            'nutrient_id'           =>'1',
            'composition'           =>'87.0'
        ],
        [
            'feed_id'               =>'19',
            'nutrient_id'           =>'7',
            'composition'           =>'70.0'
        ],
        [
            'feed_id'               =>'19',
            'nutrient_id'           =>'3',
            'composition'           =>'15.00'
        ],
        [
            'feed_id'               =>'19',
            'nutrient_id'           =>'8',
            'composition'           =>'1.000'
        ],
        [
            'feed_id'               =>'19',
            'nutrient_id'           =>'9',
            'composition'           =>'0.800'
        ],
        [
            'feed_id'               =>'20',
            'nutrient_id'           =>'1',
            'composition'           =>'14.6'
        ],
        [
            'feed_id'               =>'20',
            'nutrient_id'           =>'7',
            'composition'           =>'77.9'
        ],
        [
            'feed_id'               =>'20',
            'nutrient_id'           =>'3',
            'composition'           =>'30.30'
        ],
        [
            'feed_id'               =>'20',
            'nutrient_id'           =>'8',
            'composition'           =>'0.882'
        ],
        [
            'feed_id'               =>'20',
            'nutrient_id'           =>'9',
            'composition'           =>'0.141'
        ]
        ]);
        	
    }
}
