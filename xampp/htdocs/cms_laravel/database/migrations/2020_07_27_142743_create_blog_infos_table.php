<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //タイトル
            $table->text('description'); //ディスクリプション
            $table->string('twitter_url'); //twitter_url
            $table->string('instagram_url'); //instagram_url
            $table->string('facebook_url'); //facebook_url
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
        Schema::dropIfExists('blog_infos');
    }
}
