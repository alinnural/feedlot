<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollbackChangePriceResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forsum_feeds', function (Blueprint $table) {
            $table->renameColumn('price_bs', 'price');
            $table->renameColumn('result_bs', 'result');
            $table->dropColumn('price_bk')->default(0);
            $table->dropColumn('result_bk')->default(0);
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
