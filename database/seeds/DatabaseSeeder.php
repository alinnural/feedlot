<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(GroupFeedsTableSeeder::class);
        $this->call(FeedsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(NutrientsTableSeeder::class);
        $this->call(RequirementsTableSeeder::class);
        $this->call(RequirementNutrientsTableSeeder::class);
        $this->call(FeedNutrientsTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(SettingTableSeeder::class);
    }
}
