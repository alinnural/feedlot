<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsHasNutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_nutrients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requirement_id')->unsigned()->index();
            $table->integer('nutrient_id')->unsigned()->index();
            $table->float('composition',8,2);
            $table->timestamps();

            $table->foreign('requirement_id')->references('id')->on('requirements')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nutrient_id')->references('id')->on('nutrients')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirement_nutrients');
    }
}
