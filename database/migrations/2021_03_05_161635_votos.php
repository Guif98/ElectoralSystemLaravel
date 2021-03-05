<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Votos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cpf');
            $table->tinyInteger('subProjeto_id')->unsigned();
            $table->foreign('subProjeto_id')->references('id')->on('subProjetos');
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
        Schema::dropIfExists('votos');
    }
}
