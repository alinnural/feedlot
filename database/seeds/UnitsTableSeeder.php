<?php

use Illuminate\Database\Seeder;
use App\GroupFeed;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
        ['name'      =>'Unit 1', 'symbol' => 'U1']
        ]);
    }
}