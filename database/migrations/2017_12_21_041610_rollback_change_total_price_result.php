<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollbackChangeTotalPriceResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forsums', function (Blueprint $table) {
            $table->renameColumn('total_price_bs', 'total_price');
            $table->dropColumn('total_price_bk')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forsums', function (Blueprint $table) {
            //
        });
    }
}
