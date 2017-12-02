<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('requirements', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        Schema::table('requirement_has_nutrients', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        Schema::table('nutrients', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        Schema::table('group_feeds', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        Schema::table('feeds', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        Schema::table('feed_has_nutrients', function (Blueprint $table) {
            $table->dropColumn(
                'created_at',
                'updated_at'      
            );
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::table('requirements', function (Blueprint $table) {           
            $table->timestamps();
        });
        Schema::table('requirement_has_nutrients', function (Blueprint $table) {           
            $table->timestamps();
        });
        Schema::table('nutrients', function (Blueprint $table) {           
            $table->timestamps();
        });
        Schema::table('units', function (Blueprint $table) {           
            $table->timestamps();
        });
        Schema::table('group_feeds', function (Blueprint $table) {           
            $table->timestamps();
        });
        Schema::table('feeds', function (Blueprint $table) {           
            $table->timestamps();
        });
        Schema::table('feed_has_nutrients', function (Blueprint $table) {            
            $table->timestamps();
        });
        */
    }
}
