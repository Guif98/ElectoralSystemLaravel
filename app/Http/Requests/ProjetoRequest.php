<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string',
            'dataInicio' => 'required|date|before:dataFim|unique:projetos,dataInicio,'.$this->id,
            'dataFim' => 'required|date|unique:projetos,dataFim,'.$this->id,
            'ativo' => 'unique:projetos,ativo,0'
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'dataInicio.required' => 'O campo Data de início é obrigatório',
            'dataFim.required' => 'O campo Data de Fim é obrigatório'
        ];
    }
}
