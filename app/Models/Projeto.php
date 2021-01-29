<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;
    protected $table = 'projetos';
    protected $fillable = [
        'nome', 'dataInicio', 'dataFim'
    ];

    public function relSubProjetos() {
        return $this->hasMany('App/Models/SubProjetos', 'projeto_id');
    }
}
