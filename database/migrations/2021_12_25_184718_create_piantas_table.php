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
            $table->bigIncrements('Codice_pianta');
            
            $table->string('Nome', 100);
            $table->string('Luogo', 100);
            $table->tinyInteger('Stato');

            $table->timestamps();
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
