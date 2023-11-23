<?php

namespace App\Http\Requests\Usuario;

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
            'nome' => 'required',
            'senha' => 'required',
            'email' => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'senha' => 'Senha',
            'email' => 'Email',
        ];
    }
}

