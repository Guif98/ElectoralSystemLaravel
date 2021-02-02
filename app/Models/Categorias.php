<?php

namespace App\Models;

use App\Models\SubProjetos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $fillable = ['nome', 'projeto_id'];

    public function relSubProjetos() {
        return $this->hasOne(\App\Models\SubProjetos::class);
    }

    public function relProjeto() {
        return $this->hasOne(\App\Models\Projeto::class);
    }

}
