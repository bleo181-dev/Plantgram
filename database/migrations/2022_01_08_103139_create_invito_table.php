<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invito', function (Blueprint $table) {
            $table->bigIncrements('codice_invito');
            $table->string('email');
            $table->string('token', 20)->unique();
            $table->unsignedBigInteger('codice_serra');
            $table->unsignedBigInteger('id');
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
        Schema::dropIfExists('invito');
    }
}
