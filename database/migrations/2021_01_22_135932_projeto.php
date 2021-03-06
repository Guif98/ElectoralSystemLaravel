<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projeto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nome')->nullable();
            $table->string('capa')->nullable();
            $table->boolean('ativo')->default(0);
            $table->boolean('desativado_permanentemente')->default(0);
            $table->date('dataInicio')->nullable()->date_format('d/m/Y');
            $table->date('dataFim')->nullable()->date_format('d/m/Y');
            $table->date('dataResultado')->nullable()->date_format('d/m/Y');
            $table->boolean('exibirResultado')->default(0);
            $table->timestamps();
            $table->int('excluido')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('projetos');

    }
}
