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
            $value = 0;
            $table->increments('id');
            $table->string('feed_stuff',100)->comment('Name of feed');
            $table->integer('group_feed_id')->unsigned();	
            $table->float('dry_matter')->comment('Dry Matter  (DM)')->default($value);
            $table->float('mineral')->comment('Mineral (Ash)')->default($value);
            $table->float('organic_matter')->comment('Organic Matter (OM)')->default($value);
            $table->float('lignin')->comment('Lignin (Lig)')->default($value);
            $table->float('neutral_detergent_fiber')->comment('Neutral Detergent Fiber (NDF)')->default($value);
            $table->float('ether_extract')->comment('Ether Extract (EE)')->default($value);
            $table->float('nonfiber_carbohydrates')->comment('Non-Fiber Carbohydrates (NFC)')->default($value);
            $table->float('total_digestible_nutrients')->comment('Total Digestible Nutrients (TDN)')->default($value);
            $table->float('metabolizable_energy')->comment('Metabolizable Energy (ME)')->default($value);
            $table->float('rumen_degradable')->comment('Rumen Degradable Protein (RDP)')->default($value);
            $table->float('rumen_undegradable')->comment('Rumen Undegradable Protein (RUP)')->default($value);
            $table->float('rumen_soluble')->comment('Rumen soluble protein fraction A (CP A)')->default($value);
            $table->float('rumen_insoluble')->comment('Rumen insoluble protein fraction B (CP B)')->default($value);
            $table->float('degradation_rate')->comment('Degradation rate of fraction B (CP kd)')->default($value);
            $table->float('crude_protein')->comment('Crude Protein (CP)')->default($value);
            $table->float('metabolizable_protein')->comment('Metabolizable Protein (MP)')->default($value);
            $table->float('calcium')->comment('Calcium (Ca)')->default($value);
            $table->float('phosphorus')->comment('Phosphorus (P)')->default($value);
            $table->float('magnesium')->comment('Magnesium (Mg)')->default($value);
            $table->float('potassium')->comment('Potassium (K)')->default($value);
            $table->float('sodium')->comment('Sodium (Na)')->default($value);
            $table->float('sulfur')->comment('Sulfur (S)')->default($value);
            $table->float('cobalt')->comment('Cobalt (Co)')->default($value);
            $table->float('copper')->comment('Copper (Cu)')->default($value);
            $table->float('iodine')->comment('Iodine (I)')->default($value);
            $table->float('manganese')->comment('Manganese (Mn)')->default($value);
            $table->float('selenium')->comment('Selenium (Se)')->default($value);
            $table->float('zinc')->comment('Zinc (Zn)')->default($value);
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
