<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatterDiscussionTable extends Migration
{
    public function up()
    {
        Schema::create('chatter_discussion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chatter_category_id')->unsigned();
            $table->string('title');
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('sticky');
            $table->integer('views')->unsigned();
            $table->boolean('answered');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('chatter_discussion');
    }
}
