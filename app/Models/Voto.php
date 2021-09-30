<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Voto extends Model
{
    use HasFactory;

    protected $table = 'votos';
    protected $fillable = ['projeto_id', 'nome', 'sobrenome', 'cpf', 'subProjeto_id', 'categoira_id'];

    public function relSubProjeto() {
        return $this->hasOne(\App\Models\SubProjetos::class, 'id', 'subProjeto_id');
    }

    public function relCategoria() {
        return $this->hasOne(\App\Models\SubProjetos::class, 'id', 'categoria_id');
    }
}
