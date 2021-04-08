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
        $projetos = Projeto::all();

        foreach($projetos as $projeto) {
            $dataFinal = strtotime($projeto->dataFim)-time();
            $dataInicial = strtotime($projeto->dataInicio)-time();
            $periodoVotacao = $dataFinal - $dataInicial;
            $hoje = strtotime(Date(now())) - time();
            $periodoAtual = $hoje - $dataInicial;

            if ($periodoAtual >= $periodoVotacao || $periodoAtual < $dataInicial) {
                $projeto->ativo = 0;
                $projeto->save();
            }

            else {
                $projeto->ativo = 1;
                $projeto->save();
            }

/*            $votacaoPeriodo = date_diff(date_create($projeto->dataFim), date_create($projeto->dataInicio));
            $votacaoForaPeriodo = date_diff(date_create(Date(now())), date_create($projeto->dataInicio));*/

        }


    }
}
