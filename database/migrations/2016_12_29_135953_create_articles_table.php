<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');//标题
            $table->integer('firsttitle')->unsigned()->default(0);//是否头条
            $table->integer('ismember')->unsigned()->default(0);//是否会员
            $table->integer('userid')->unsigned()->default(0);//用户名id
            $table->char('username',20);//用户名
            $table->integer('classid')->unsigned()->default(0);//分类id
            $table->string('keyboard',100);//关键字
            $table->integer('onclick')->unsigned()->default(0);//点击数
            $table->string('titlepic',120);//标题图片
            $table->string('smalltext',255);//文章简介
            $table->integer('diggtop')->unsigned()->default(0);//推荐
            $table->timestamps();
            $table->index(['id', 'classid']);//添加索引
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
