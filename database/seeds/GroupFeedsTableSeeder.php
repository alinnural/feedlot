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
        ['name'=>'Hijauan'],
        ['name'=>'Energi'],
        ['name'=>'Protein'],
        ['name'=>'Mineral']
        ]);
    }
}