<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collabora', function (Blueprint $table) {
            $table->bigIncrements('codice_collaborazione');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('codice_serra');
            $table->timestamps();

            $table->foreign('codice_serra')->references('codice_serra')->on('serra')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collabora');
    }
}
