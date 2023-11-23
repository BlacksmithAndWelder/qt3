<?php

namespace App\Http\Requests\Turma;

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
            'escola_id'   => 'required',
            'ativo'       => 'boolean',
            'equipe'      => 'required|string|in:A,B,C,D',
            'sala'        => 'required|numeric|in:1,2,3,4',
        ];
    }
    
    public function attributes()
    {
        return [
            'escola_id'   => 'Escola',
            'ativo'       => 'Ativo',
            'equipe'      => 'Equipe',
            'sala'        => 'Sala',
        ];
    }
}
