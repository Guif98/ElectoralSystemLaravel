<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eleitores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleitores', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('cpf')->unique()->nullable(false);
            $table->date('nascimento')->nullable(false);
            $table->string('telefone')->nullable(false);
            $table->string('nome')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('endereco')->nullable(false);
            $table->string('bairro')->nullable(false);
            $table->string('cidade')->nullable(false);
            $table->string('uf')->nullable(false);
            $table->dateTime('data_hora')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleitores');

    }
}
