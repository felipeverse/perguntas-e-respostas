<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGincanaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gincana_grupos', function (Blueprint $table) {
            $table->id();
            $table->integer('ordem');
            $table->string('nome');
            $table->string('cor');

            $table->unsignedBigInteger('gincana_id');
            $table->foreign('gincana_id')->references('id')->on('gincanas');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gincana_grupos');
    }
}
