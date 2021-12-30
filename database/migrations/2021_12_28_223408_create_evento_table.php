<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('codice_evento');
            $table->unsignedBigInteger('codice_pianta');
            $table->unsignedBigInteger('codice_utente');
            $table->string('nome', 100);
            $table->timestampTz('data', $precision = 0);
            $table->timestamps();

            $table->foreign('codice_pianta')->references('codice_pianta')->on('pianta')->onDelete('cascade');
            $table->foreign('codice_utente')->references('codice_utente')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
