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
        Schema::create('forsum_has_feed', function (Blueprint $table) {
            $table->integer('forsum_id')->unsigned();
            $table->integer('feed_id')->unsigned();
            $table->integer('price');
            $table->timestamps();

            $table->foreign('forsum_id')->references('id')->on('forsum')
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
        Schema::dropIfExists('forsum_has_feed');
    }
}
