<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiantaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pianta', function (Blueprint $table) {
            $table->bigIncrements('codice_pianta');
            $table->unsignedBigInteger('codice_serra');
            $table->string('nome', 100);
            $table->string('luogo', 100);
            $table->tinyInteger('stato');
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
        Schema::dropIfExists('pianta');
    }
}
