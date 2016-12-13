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
            $table->integer('group_feed_id')->unsigned();	
            $table->float('dry_matter')->comment('Dry Matter  (DM)');
            $table->float('mineral')->comment('Mineral (Ash)');
            $table->float('organic_matter')->comment('Organic Matter (OM)');
            $table->float('lignin')->comment('Lignin (Lig)');
            $table->float('neutral_detergent_fiber')->comment('Neutral Detergent Fiber (NDF)');
            $table->float('ether_extract')->comment('Ether Extract (EE)');
            $table->float('nonfiber_carbohydrates')->comment('Non-Fiber Carbohydrates (NFC)');
            $table->float('total_digestible_nutrients')->comment('Total Digestible Nutrients (TDN)');
            $table->float('metabolizable_energy')->comment('Metabolizable Energy (ME)');
            $table->float('rumen_degradable')->comment('Rumen Degradable Protein (RDP)');
            $table->float('rumen_undegradable')->comment('Rumen Undegradable Protein (RUP)');
            $table->float('rumen_soluble')->comment('Rumen soluble protein fraction A (CP A)');
            $table->float('rumen_insoluble')->comment('Rumen insoluble protein fraction B (CP B)');
            $table->float('degradation_rate')->comment('Degradation rate of fraction B (CP kd)');
            $table->float('crude_protein')->comment('Crude Protein (CP)');
            $table->float('metabolizable_protein')->comment('Metabolizable Protein (MP)');
            $table->float('calcium')->comment('Calcium (Ca)');
            $table->float('phosphorus')->comment('Phosphorus (P)');
            $table->float('magnesium')->comment('Magnesium (Mg)');
            $table->float('potassium')->comment('Potassium (K)');
            $table->float('sodium')->comment('Sodium (Na)');
            $table->float('sulfur')->comment('Sulfur (S)');
            $table->float('cobalt')->comment('Cobalt (Co)');
            $table->float('copper')->comment('Copper (Cu)');
            $table->float('iodine')->comment('Iodine (I)');
            $table->float('manganese')->comment('Manganese (Mn)');
            $table->float('selenium')->comment('Selenium (Se)');
            $table->float('zinc')->comment('Zinc (Zn)');
            $table->timestamps();

            $table->foreign('group_feed_id')->references('id')->on('group_feeds')
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
        Schema::dropIfExists('feeds');
    }
}
