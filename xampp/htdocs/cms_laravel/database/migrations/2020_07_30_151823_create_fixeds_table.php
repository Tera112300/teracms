<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixeds', function (Blueprint $table) {
            $table->id(); //一意のid
            $table->string('fixed_title'); //タイトル
            $table->text('fixed_content'); //コンテンツ
            $table->text('fixed_excerpt'); //抜粋文
            $table->text('fixed_url'); //投稿のurl
            $table->enum('fixed_status', ['非公開', '公開']); //公開状態
            $table->string('fixed_guid'); //アイキャッチ画像url
            $table->unsignedBigInteger('fixed_user'); //投稿したユーザー名
            $table->string('seo_title'); //seoタイトル
            $table->text('meta_description'); //ディスクリプション
            $table->text('meta_keywords'); //キーワード
            $table->timestamps(); //created_at(作成時間) updated_at(更新日時) 自動更新
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixeds');
    }
}
