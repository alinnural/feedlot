<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feeds', function (Blueprint $table) {
            $table->dropForeign('feeds_group_feed_id_foreign');
            $table->dropColumn(
                'feed_stuff',
                'dry_matter',
                'mineral',
                'organic_matter',
                'lignin',
                'neutral_detergent_fiber',
                'ether_extract',
                'zinc',
                'selenium',
                'manganese',
                'iodine',
                'copper',
                'cobalt',
                'sulfur',
                'sodium',
                'potassium',
                'magnesium',
                'phosphorus',
                'calcium',
                'metabolizable_protein',
                'crude_protein',
                'degradation_rate',
                'rumen_insoluble',
                'rumen_soluble',
                'rumen_undergradable_dm',
                'rumen_undergradable_cp',
                'rumen_degradable_dm',
                'rumen_degradable_cp',
                'metabolizable_energy',
                'total_digestible_nutrients',
                'nonfiber_carbohydrates'                
            );

            $table->string('name')->after('id');
            $table->float('min',8,2)->nullable();;
            $table->float('max',8,2)->nullable();;
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
        Schema::table('feeds', function (Blueprint $table) {
        });
    }
}
