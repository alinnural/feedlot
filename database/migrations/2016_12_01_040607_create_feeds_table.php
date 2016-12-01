<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('feed_stuff',100)->comment('Name of feed');	
            $table->integer('energy_dm')->comment('Dry Matter');	
            $table->integer('energy_tdn')->comment('Total Digestible Nutrients');	
            $table->integer('energy_nem')->comment('Net Energy Maintenance');	
            $table->integer('energy_neg')->comment('net energy for gain');	
            $table->integer('energy_nel')->comment('net energy for lactation');	
            $table->integer('protein_cp')->comment('Crude Protein');	
            $table->integer('protein_uip')->comment('Undegradable Intake Protein');	
            $table->integer('protein_npn');
            $table->integer('fiber_cf')->comment('Crude Fiber');	
            $table->integer('fiber_adf')->comment('acid detergent fiber');	
            $table->integer('fiber_ndf')->comment('Neutral Detergent Fiber');	
            $table->integer('fiber_endf');	
            $table->float('ee',8,3)->comment('Ether Extract');
            $table->integer('ash');
            $table->float('ca',8,3)->comment('Calsium');	
            $table->float('p',8,3)->comment('Phosphorus');	
            $table->float('k',8,3)->comment('Kalium');	
            $table->float('cl',8,3)->comment('Clor');	
            $table->float('s',8,3)->comment('Sulfur');	
            $table->integer('zn')->comment('Zinc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}
