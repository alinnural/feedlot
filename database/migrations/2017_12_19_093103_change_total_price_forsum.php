<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTotalPriceForsum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forsums', function (Blueprint $table) {
            $table->renameColumn('total_price', 'total_price_bs');
            $table->integer('total_price_bk')->default(0);
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
