<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Projeto;

use DateTime;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\Foreach_;

class MinuteUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando irá verificar e desativar o projeto/evento ao passar de seu prazo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hoje = strtotime(Date(today())) - time();
        $projetos = Projeto::where('ativo', 0)->get();
        $projetoAtivo = Projeto::where('ativo', 1)->get();

        foreach ($projetoAtivo as $pAtivo) {
            $dataFinalAtivo = strtotime($pAtivo->dataFim)-time();
            $dataInicialAtivo = strtotime($pAtivo->dataInicio)-time();
            $periodoVotacaoAtivo = $dataFinalAtivo - $dataInicialAtivo;
            $periodoAtualAtivo = $hoje - $dataInicialAtivo;


            if ($pAtivo->desativado_permanentemente == 1) {
                $pAtivo->ativo = 0;
                $pAtivo->save();
            }
            else if ($periodoVotacaoAtivo < $periodoAtualAtivo) {
                $pAtivo->desativado_permanentemente = 1;
                $pAtivo->ativo = 0;
                $pAtivo->save();
            }
        }

        foreach($projetos as $projeto) {
            $dataFinal = strtotime($projeto->dataFim)-time();
            $dataInicial = strtotime($projeto->dataInicio)-time();
            $periodoVotacao = $dataFinal - $dataInicial;
            $periodoAtual = $hoje - $dataInicial;


            if ($periodoAtual > $periodoVotacao || $periodoAtual < $dataInicial) {
                $projeto->ativo = 0;
                $projeto->save();
            }
            else if ($projeto->desativado_permanentemente == 1) {
                $projeto->ativo = 0;
                $projeto->save();
            }
            else if ($projetoAtivo->count() == 0 && $periodoAtual <= $periodoVotacao){
                $projeto->ativo = 1;
                $projeto->save();
            }
            else if ($projetoAtivo->count() == 0 && $periodoAtual <= $periodoVotacao && $projeto->desativado_permanentemente == 0) {
                $projeto->ativo = 1;
                $projeto->save();
            }
/*            $votacaoPeriodo = date_diff(date_create($projeto->dataFim), date_create($projeto->dataInicio));
            $votacaoForaPeriodo = date_diff(date_create(Date(now())), date_create($projeto->dataInicio));*/

        }


    }
}
