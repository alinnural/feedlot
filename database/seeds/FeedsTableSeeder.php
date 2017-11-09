<?php

use Illuminate\Database\Seeder;
use App\Feeds;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feeds')->insert([
        [
            'name'              =>'Jerami Padi',	
            'min'               =>'0',
            'max'               =>'30',
            'group_feed_id'     =>'1'
        ],
        [
            'name'              =>'Rumput Lapang',	
            'min'               =>'0',
            'max'               =>'50',	
            'group_feed_id'     =>'1'
        ],
        [
            'name'              =>'Rumput Gajah',		
            'min'               =>'0',
            'max'               =>'50',
            'group_feed_id'     =>'1'
        ],
        [
            'name'              =>'Daun Jagung',		
            'min'               =>'0',
            'max'               =>'40',
            'group_feed_id'     =>'1'
        ],
        [
            'name'              =>'Daun Singkong',	
            'min'               =>'0',
            'max'               =>'30',	
            'group_feed_id'     =>'1'
        ],
        [
            'name'              =>'Daun Lamtoro',		
            'min'               =>'0',
            'max'               =>'30',
            'group_feed_id'     =>'1'
        ],
        [
            'name'              =>'Jagung',		
            'min'               =>'10',
            'max'               =>'50',
            'group_feed_id'     =>'2'
        ],
        [
            'name'              =>'Onggok',		
            'min'               =>'0',
            'max'               =>'40',
            'group_feed_id'     =>'2'
        ],
        [
            'name'              =>'Molases',		
            'min'               =>'5',
            'max'               =>'7',
            'group_feed_id'     =>'2'
        ],
        [
            'name'              =>'Dedak Padi Halus',		
            'min'               =>'0',
            'max'               =>'40',
            'group_feed_id'     =>'2'
        ],
        [
            'name'              =>'Singkong',		
            'min'               =>'0',
            'max'               =>'30',
            'group_feed_id'     =>'3'
        ],
        [
            'name'              =>'Biji Kedelai',	
            'min'               =>'0',
            'max'               =>'20',	
            'group_feed_id'     =>'3'
        ],
        [
            'name'              =>'Bungkil Kelapa Sawit',	
            'min'               =>'0',
            'max'               =>'30',	
            'group_feed_id'     =>'3'
        ],
        [
            'name'              =>'Bungkil Kelapa',	
            'min'               =>'0',
            'max'               =>'30',	
            'group_feed_id'     =>'3'
        ],
        [
            'name'              =>'Ampas Kecap',	
            'min'               =>'0',
            'max'               =>'20',	
            'group_feed_id'     =>'3'
        ],
        [
            'name'              =>'Kapur',		
            'min'               =>'0',
            'max'               =>'2',
            'group_feed_id'     =>'4'
        ],
        [
            'name'              =>'Kalsium Karbonat',	
            'min'               =>'0',
            'max'               =>'2',	
            'group_feed_id'     =>'4'
        ],
        [
            'name'              =>'Garam',		
            'min'               =>'0.25',
            'max'               =>'1',
            'group_feed_id'     =>'4'
        ]
        ]);
    }
}
