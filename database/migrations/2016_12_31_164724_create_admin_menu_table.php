<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('admin_menu', function(Blueprint $table)
//        {
//            $table->increments('id');
//            $table->string('title',70);
//            $table->string('introduce',200);
//            $table->string('path',100);
//            $table->integer('parentId')->unsigned()->default(0);
//            $table->string('ioc',50);
//            $table->timestamps();
//        });
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
