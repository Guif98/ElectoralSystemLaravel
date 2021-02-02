<?php

namespace App\Models;

use App\Models\Categorias;
use App\Models\Projeto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProjetos extends Model
{
    use HasFactory;
    protected $table = 'subProjetos';
    protected $fillable = ['titulo', 'projeto_id', 'categoria_id', 'descricao', 'integrantes', 'foto'];

    public function SubProjeto() {
        return $this->belongsTo(Projeto::class, 'id');
    }



    public function relCategorias() {
        return $this->hasOne(\App\Models\Categorias::class, 'id', 'categoria_id');
    }

    public function relProjeto() {
        return $this->hasOne(\App\Models\Projeto::class, 'projeto_id', 'projeto_id');
    }

    public function relFotos() {
        return $this->hasMany(\App\Models\Foto::class, 'subprojeto_id');
    }
}
