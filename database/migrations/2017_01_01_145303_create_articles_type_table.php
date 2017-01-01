<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_class', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);//标题
            $table->string('ioc',50);//分类图标
            $table->string('describe',50);//分类简介
            $table->integer('parentId')->unsigned()->default(0);//父级分类
            $table->index(['id', 'parentId']);//添加索引
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
