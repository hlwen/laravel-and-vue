<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classid')->unsigned()->default(0);//分类id
            $table->string('keyid',255);//
            $table->integer('haveaddfen')->unsigned()->default(0);//所在标签
            $table->integer('dokey')->unsigned()->default(0);//做关键
            $table->string('infotags',80);//所在标签
            $table->string('writer',30);//作者
            $table->string('befrom',60);//来自
            $table->mediumText('text');//文章正文
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
        //
    }
}
