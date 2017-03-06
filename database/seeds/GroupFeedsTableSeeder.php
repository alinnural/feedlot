<?php

use Illuminate\Database\Seeder;
use App\GroupFeed;

class GroupFeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_feeds')->insert([
        ['name'=>'DRY FORAGE'],
        ['name'=>'FRESH FORAGE'],
        ['name'=>'SILAGE'],
        ['name'=>'ENERGETIC CONCENTRATE'],
        ['name'=>'PROTEIC CONCENTRATE'],
        ['name'=>'ADDITIVE AND OTHERS BY-PRODUCT'],
        ['name'=>'SOURCE OF MINERALS']
        ]);
    }
}