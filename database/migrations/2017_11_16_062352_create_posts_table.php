<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->text('content_raw');
            $table->text('content_html');
            $table->string('page_image')->nullable();
            $table->string('meta_description');
            $table->boolean('is_draft');
            $table->string('layout')->default('post.layouts.post');
            $table->timestamp('published_at');
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down()
    {
        Schema::drop('posts');
    }
}
