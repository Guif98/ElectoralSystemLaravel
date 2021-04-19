<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Projeto;
use Carbon\Carbon;
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
        $hoje = Carbon::createFromTimeString(Date(today()))->toDateTimeString();
        $projetos = Projeto::where('ativo', 0)->get();
        $projetoAtivo = Projeto::where('ativo', 1)->get();

        foreach ($projetoAtivo as $pAtivo) {
            $dataFinalAtivo =  Carbon::createFromFormat('Y-m-d', $pAtivo->dataFim)->endOfDay()->toDateTimeString();
            if ($pAtivo->desativado_permanentemente == 1) {
                $pAtivo->ativo = 0;
                $pAtivo->save();
            }
            else if ($dataFinalAtivo < $hoje) {
                $pAtivo->desativado_permanentemente = 1;
                $pAtivo->ativo = 0;
                $pAtivo->save();
            }
        }

        foreach($projetos as $projeto) {
            $dataFinal = Carbon::createFromFormat('Y-m-d', $projeto->dataFim)->endOfDay()->toDateTimeString();
            $dataInicial = Carbon::createFromFormat('Y-m-d', $projeto->dataInicio)->startOfDay()->toDateTimeString();
            $dataResultado = Carbon::createFromFormat('Y-m-d', $projeto->dataResultado)->startOfDay()->toDateTimeString();

            if ($dataResultado >= $hoje) {
                $projeto->exibirResultado = 1;
                $projeto->save();
            }


            if ($hoje > $dataFinal || $hoje < $dataInicial) {
                $projeto->ativo = 0;
                $projeto->save();
            }
            else if ($projeto->desativado_permanentemente == 1) {
                $projeto->ativo = 0;
                $projeto->save();
            }
            else if ($projetoAtivo->count() == 0 && $hoje <= $dataFinal){
                $projeto->ativo = 1;
                $projeto->save();
            }
            else if ($projetoAtivo->count() == 0 && $hoje <= $dataFinal && $projeto->desativado_permanentemente == 0) {
                $projeto->ativo = 1;
                $projeto->save();
            }
        }



        /*if ($projetoAtivo->dataResultado >= $hoje) {

        }*/
    }
}
