<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Projeto;
use DateTime;
use Illuminate\Support\Facades\Date;

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
    protected $description = 'Command description';

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

        foreach ($projetos as $projeto) {
            $p = $projeto->find($projeto->ativo == 1);
            if (Date(now()) > $p->dataFim) {
                $p->ativo = 0;
            }
        }
    }
}
