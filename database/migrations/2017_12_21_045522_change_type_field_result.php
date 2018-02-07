<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeFieldResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forsum_nutrients', function (Blueprint $table) {
            $table->float('result')->change();
        });
        Schema::table('forsum_feeds', function (Blueprint $table) {
            $table->float('result')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forsum_nutrients', function (Blueprint $table) {
            //
        });
    }
}
