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
            $table->integer('cpf')->unique();
            $table->string('nome')->nullable('false')->change();
            $table->string('sobrenome')->nullable('false')->change();
            $table->date('dataNascimento')->nullable('false')->change();
            $table->string('email')->unique();
            $table->string('telefone')->nullable('false')->change();
            $table->string('endereco')->nullable('false')->change();
            $table->string('bairro')->nullable('false')->change();
            $table->string('cidade')->nullable('false')->change();
            $table->string('uf')->nullable('false')->change();
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
