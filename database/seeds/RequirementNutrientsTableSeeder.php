<?php

use Illuminate\Database\Seeder;
use App\Nutrient;
use App\requirement;
use Flynsarmy\CsvSeeder\CsvSeeder;

class RequirementNutrientsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'requirement_nutrients';
		$this->filename = base_path().'/database/seeds/csvs/requirement_nutrients.csv';
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
