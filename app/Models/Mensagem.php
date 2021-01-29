<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    /**use HasFactory;
    private static $erro = [];
	private static $padrao = [];
    private static $sucesso = [];


    public static function erro($mensagem) {
        self::set('erro', $mensagem);
    }

    public static function padrao($mensagem) {
        self::set('padrao', $mensagem);
    }

    public static function sucesso($mensagem) {
        self::set('sucesso', $mensagem);
    }

    public static function montarMensagem() {

        $mensagens = array_merge(self::$erro, self::$padrao, self::$sucesso);

        $retorno = '';

        foreach($mensagens as $mensagem) {
            $registro = array();

            switch($mensagem[0]){
				case 'erro':
					$registro['classe'] = 'alert-danger';
					break;
				case 'padrao':
					$registro['classe'] = 'alert-warning';
					break;
				case 'sucesso':
					$registro['classe'] = 'alert-success';
					break;
            }

            $registro['mensagem'] = $mensagem[1];

            ob_start();
			include('mensagem');
			$retorno.= ob_get_clean();
        }
    }

    private function set($tipo, $mensagem){
		//Verifica se há mensagem para adicionar
		if(strlen($mensagem) == 0) return false;

		//Verifica se o tipo da mensagem é válido
		if(!in_array($tipo, ['padrao', 'erro', 'sucesso'])) return false;

		//Adiciona mensagem à variável relativa
		array_push(self::$$tipo, array($tipo, $mensagem));
    }
    **/
}

