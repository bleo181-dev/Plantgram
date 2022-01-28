<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePubblicitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pubblicita', function (Blueprint $table) {
            $table->bigIncrements('codice_pubblicita');
            $table->timestamps();

            $table->string('produttore');
            $table->string('body');
            $table->BigInteger('priorita');
        });

        DB::statement("ALTER TABLE pubblicita ADD foto MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pubblicita');
    }
}
