<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleitorRequest extends FormRequest
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
            'cpf' => 'required|numeric|max:11',
            'nascimento' => 'required|date|date_format:d/m/Y',
            'telefone' => 'required|numeric|max:12',
            'nome' => 'required|string|max:80',
            'email' => 'required|email',
            'endereco' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|max:2'
        ];
    }
}
