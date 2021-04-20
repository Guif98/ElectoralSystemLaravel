<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    protected $fillable = ['subprojeto_id', 'foto'];

    public function relSubProjeto() {
        return $this->hasOne(\App\Models\SubProjetos::class, 'id', 'subprojeto_id');
    }
}
