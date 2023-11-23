<?php

namespace App\Http\Requests\SuporteTarefa;

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
            'user_id'   => 'required',
            'status_id' => 'required',
            'urgente'   => 'required|boolean',
            'assunto'   => 'required|string',
            'descricao' => 'required|string'
        ];
    }
    
    public function attributes()
    {
        return [
            'user_id'   => 'Usuário',
            'status_id' => 'Status',
            'urgente'   => 'Urgente',
            'assunto'   => 'Assunto',
            'descricao' => 'Descrição'
        ];
    }
}
