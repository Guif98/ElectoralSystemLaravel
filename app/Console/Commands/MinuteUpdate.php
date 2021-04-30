<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Projeto;
use Carbon\Carbon;


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
    protected $description = 'Este comando irá verificar e desativar todos os projetos/eventos a cada 30 minutos ao passar de seu prazo';

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
            $dataFim =  Carbon::createFromFormat('Y-m-d', $pAtivo->dataFim)->endOfDay()->toDateTimeString();

            if ($pAtivo->desativado_permanentemente == 1) {
                $pAtivo->ativo = 0;
                $pAtivo->save();
            }
            else if ($dataFim < $hoje) {
                $pAtivo->desativado_permanentemente = 0;
                $pAtivo->ativo = 0;
                $pAtivo->save();
            }
        }

        foreach($projetos as $projeto) {
            $dataFinal = Carbon::createFromFormat('Y-m-d', $projeto->dataFim)->endOfDay()->toDateTimeString();
            $dataInicial = Carbon::createFromFormat('Y-m-d', $projeto->dataInicio)->startOfDay()->toDateTimeString();
            $dataResultado = Carbon::createFromFormat('Y-m-d', $projeto->dataResultado)->startOfDay()->toDateTimeString();


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
            else if ($projeto->dataResultado <= $hoje) {
                $projeto->ativo = 0;
                $projeto->desativado_permanentemente = 1;
                $projeto->save();
            }

            else if ($projetoAtivo->count() == 0 && $hoje <= $dataFinal && $projeto->desativado_permanentemente == 0) {
                $projeto->ativo = 1;
                $projeto->save();
            }
        }

        foreach($projetos as $projeto) {

            if ($dataResultado <= $hoje) {
                $projeto->desativado_permanentemente = 1;
                $projeto->exibirResultado = 1;
                $projeto->save();
            }
        }

    }
}
