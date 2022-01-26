<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serra', function (Blueprint $table) {
            $table->bigIncrements('codice_serra');
            $table->unsignedBigInteger('id');
            $table->string('nome', 100);
            $table->BigInteger('capienza');
            $table->unsignedDecimal('latitudine', 8,6);
            $table->unsignedDecimal('longitudine', 9,6);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serra');
    }
}
