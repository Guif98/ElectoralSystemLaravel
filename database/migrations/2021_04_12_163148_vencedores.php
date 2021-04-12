<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vencedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vencedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable('false');
            $table->bigInteger('quantidade_votos')->nullable('false');
            $table->tinyInteger('projeto_id')->unsigned()->nullable('false');
            $table->tinyInteger('categoria_id')->unsigned()->nullable('false');
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('vencedores');
    }
}
