<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;

    protected $table = 'votos';
    protected $fillable = ['projeto_id', 'nome', 'sobrenome', 'cpf', 'subProjeto_id'];

    public function relSubProjeto() {
        return $this->hasOne(\App\Models\SubProjetos::class, 'id', 'subProjeto_id');
    }
}
