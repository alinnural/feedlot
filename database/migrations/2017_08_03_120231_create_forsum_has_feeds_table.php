<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForsumHasFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forsum_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forsum_id')->unsigned()->index();
            $table->integer('feed_id')->unsigned()->index();
            $table->integer('price');
            $table->timestamps();

            $table->foreign('forsum_id')->references('id')->on('forsums')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('feed_id')->references('id')->on('feeds')
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
        Schema::dropIfExists('forsum_feeds');
    }
}
