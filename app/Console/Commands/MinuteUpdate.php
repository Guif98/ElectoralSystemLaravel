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
        $desativados = Projeto::where('ativo', 0)->get();

        foreach($desativados as $desativado) {
            $desativado->dataInicio = date_diff(date_create($desativado->dataInicio), date_create(Date(now())));
            if ($desativado->dataInicio->invert == 1) {
                $desativado->ativo = 1;
                $desativado->save();
                return -1;
            }
            $desativado->dataFim = date_diff(date_create(Date(now())), date_create($desativado->dataFim));
            if ($desativado->dataFim->invert == 1) {
                $desativado->ativo = 1;
                $desativado->save();
                return 1;
            }

            return 0;
        }

    }
}
