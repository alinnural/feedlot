<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForsumHasNutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forsum_nutrients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forsum_id')->unsigned()->index();
            $table->integer('nutrient_id')->unsigned()->index();
            $table->integer('min');
            $table->integer('max');
            $table->timestamps();

            $table->foreign('forsum_id')->references('id')->on('forsums')
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
        Schema::dropIfExists('forsum_nutrients');
    }
}
