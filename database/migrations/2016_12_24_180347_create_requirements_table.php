<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('animal_type',100)->comment('Type Animal Ruminan');
            $table->integer('finish')->comment('Mature Weight');
            $table->integer('current')->comment('Body Weight');
            $table->float('adg', 8, 3)->comment('Average Daily Gain');
            $table->float('dmi', 8, 3)->comment('Dry Matter Intake');
            $table->float('tdn', 8, 3)->comment('Total Digestible Nutrient');
            $table->float('nem',8,3)->comment('Net energy requirements for maintenance');
            $table->float('neg',8,3)->comment('Net energy requirements for gain');
            $table->float('cp',8,3)->comment('Crude protein requirements');
            $table->float('ca', 8, 3)->comment('Total dietary requirements of calcium');
            $table->float('p', 8, 3)->comment('Total dietary requirements of phosphorus');
            $table->integer('month_pregnant')->comment('month');
            $table->integer('month_calvin')->comment('Months Since Calving');
            $table->integer('peak_milk')->comment('Peak Milk');
            $table->float('current_milk')->comment('Current Milk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirements');
    }
}
