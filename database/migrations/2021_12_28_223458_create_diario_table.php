<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diario', function (Blueprint $table) {
            $table->bigIncrements('codice_diario');
            $table->unsignedBigInteger('codice_utente');
            $table->unsignedBigInteger('codice_pianta');
            $table->string('testo',1000);
            $table->timestampTz('data',$precision=0);
            $table->timestamps();

            $table->foreign('codice_pianta')->references('codice_pianta')->on('pianta')->onDelete('cascade');
            $table->foreign('codice_utente')->references('codice_utente')->on('users')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE diario ADD foto MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diario');
    }
}
