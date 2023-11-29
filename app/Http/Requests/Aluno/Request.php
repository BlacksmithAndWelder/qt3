<?php

namespace App\Http\Requests\Aluno;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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
            'nome'          => 'string|required|max:256',
            'sobrenome'     => 'string|required|max:256',
            'idade'         => 'required|numeric',
            'bolsa_estudos' => 'required|boolean',
            'turma_id'      => 'required|numeric',
        ];
    }
    
    public function attributes()
    {
        return [
            'nome'          => 'Nome',
            'sobrenome'     => 'Sobrenome',
            'idade'         => 'Idade',
            'bolsa_estudos' => 'Bolsa de Estudos',
            'turma_id'      => 'Turma',
        ];
    }
}
