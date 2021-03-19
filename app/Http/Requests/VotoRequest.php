<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VotoRequest extends FormRequest
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
            'sobrenome' => 'required|string',
            'cpf' => 'required|unique:votos,cpf|size:11'
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'sobrenome.required' => 'O campo sobrenome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório e único'
        ];
    }
}
