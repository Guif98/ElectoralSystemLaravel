<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleitor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'eleitores';
    protected $fillable = [
        'cpf', 'nascimento', 'telefone', 'nome', 'email', 'endereco', 'bairro', 'cidade', 'uf'
    ];
}
