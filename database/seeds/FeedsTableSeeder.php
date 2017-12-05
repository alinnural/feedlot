<?php

use Illuminate\Database\Seeder;
use App\Feeds;
use Flynsarmy\CsvSeeder\CsvSeeder;

class FeedsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'feeds';
		$this->filename = base_path().'/database/seeds/csvs/feeds.csv';
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
        // DB::table($this->table)->truncate();

        parent::run();
    }
}
