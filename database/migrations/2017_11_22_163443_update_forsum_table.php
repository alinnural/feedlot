<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForsumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forsums', function (Blueprint $table) {
            $table->dropForeign('forsums_requirement_id_foreign');
            $table->dropColumn('requirement_id');
            $table->integer('total_price');
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
