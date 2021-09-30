<?php

namespace App\Http\Requests;

use App\Models\Projeto as ModelsProjeto;
use Illuminate\Foundation\Http\FormRequest;
use Projeto;

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
            'cpf' => 'required|size:11',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'sobrenome.required' => 'O campo sobrenome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório e único',
            'g-recaptcha-response.required' => 'Recaptcha é obrigatório'
        ];
    }
}
