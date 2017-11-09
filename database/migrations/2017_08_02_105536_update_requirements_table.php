<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requirements', function (Blueprint $table) {
            $table->dropColumn(
                'current_milk',
                'peak_milk',
                'month_calvin',
                'month_pregnant',
                'p',
                'ca',
                'cp',
                'neg',
                'nem',
                'tdn',
                'dmi',
                'adg',
                'current',
                'finish'                
            );

            $table->float('current_weight',8,2)->after('animal_type');
            $table->float('average_daily_gain',8,2)->after('current_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requirements', function (Blueprint $table) {
            //
        });
    }
}
