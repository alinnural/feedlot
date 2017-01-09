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
            $table->float('finish',8,3)->comment('Mature Weight (Kg)');
            $table->float('current',8,3)->comment('Body Weight (Kg)');
            $table->float('adg', 8, 3)->comment('Average Daily Gain (Kg/day)');
            $table->float('dmi', 8, 3)->comment('Dry Matter Intake (Kg)');
            $table->float('tdn', 8, 3)->comment('Total Digestible Nutrient (Kg)');
            $table->float('nem',8,3)->comment('Net energy requirements for maintenance (Mcal/Kg)');
            $table->float('neg',8,3)->comment('Net energy requirements for gain (Mcal/Kg)');
            $table->float('cp',8,3)->comment('Crude protein requirements %DM');
            $table->float('ca', 8, 3)->comment('Total dietary requirements of calcium %DM');
            $table->float('p', 8, 3)->comment('Total dietary requirements of phosphorus %DM');
            $table->integer('month_pregnant')->comment('month');
            $table->integer('month_calvin')->comment('Months Since Calving');
            $table->float('peak_milk',8,3)->comment('Peak Milk (Kg)');
            $table->float('current_milk')->comment('Current Milk (Kg)');
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
