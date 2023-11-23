<?php

namespace App\Http\Requests\Escola;

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
            'nome'        => 'required|max:256',
            'endereco'    => 'string|nullable',
            'pais'        => 'string|max:256',
            'max_alunos'  => 'numeric',
            'segmento'    => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'nome'          => 'Nome',
            'segmento'      => 'Segmento',
            'endereco'      => 'Endereço',
            'pais'          => 'País',
            'max_alunos'    => 'Quantidade máxima de alunos',
        ];
    }
}
