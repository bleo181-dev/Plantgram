<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBisognoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bisogno', function (Blueprint $table) {
            $table->bigIncrements('codice_bisogno');
            $table->unsignedBigInteger('codice_pianta');
            $table->string('nome', 100);
            $table->bigInteger('id');
            $table->bigInteger('cadenza');
            $table->timestamps();

            $table->foreign('codice_pianta')->references('codice_pianta')->on('pianta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bisogno');
    }
}
