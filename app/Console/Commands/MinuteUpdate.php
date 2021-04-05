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
        $projeto = Projeto::where('ativo', 0)->first();
        $projetoAtivo = Projeto::where('ativo', 1)->first();

        if (Date(now()) >= $projeto->dataInicio && Date(now()) < $projeto->dataFim && !isset($projetoAtivo)) {
            $projeto->ativo = 1;
            $projeto->save();
        } else {
            $projeto->ativo = 0;
            $projeto->save();
        }

        /*if (Date(now()) > $projeto->dataFim) {
            $projeto->ativo = 0;
            $projeto->save();
        }*/
    }
}
