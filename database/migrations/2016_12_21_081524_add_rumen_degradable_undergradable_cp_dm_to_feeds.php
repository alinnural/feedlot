<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRumenDegradableUndergradableCpDmToFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feeds', function (Blueprint $table) {
            $value = 0;
            $table->float('rumen_undergradable_cp')->after('metabolizable_energy')->default($value);
            $table->float('rumen_undergradable_dm')->after('metabolizable_energy')->default($value);
            $table->float('rumen_degradable_cp')->after('metabolizable_energy')->default($value);
            $table->float('rumen_degradable_dm')->after('metabolizable_energy')->default($value);
            $table->dropColumn('rumen_degradable');
            $table->dropColumn('rumen_undegradable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds', function (Blueprint $table) {
            // $table->dropColumn('rumen_degradable');
            // $table->dropColumn('rumen_undegradable');
        });
    }
}
