<?php

use Illuminate\Database\Seeder;
use App\FeedNutrients;
use Flynsarmy\CsvSeeder\CsvSeeder;

class FeedNutrientsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'feed_nutrients';
		$this->filename = base_path().'/database/seeds/csvs/feed_nutrients.csv';
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
		DB::disableQueryLog();
        
        // Uncomment the below to wipe the table clean before populating
        DB::table($this->table)->truncate();

        parent::run();
    }
}
