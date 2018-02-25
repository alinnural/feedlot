<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePriceResultForsumFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forsum_feeds', function (Blueprint $table) {
            $table->renameColumn('price', 'price_bs');
            $table->renameColumn('result', 'result_bs');
            $table->integer('price_bk')->default(0);
            $table->integer('result_bk')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forsum_feeds', function (Blueprint $table) {
            //
        });
    }
}
