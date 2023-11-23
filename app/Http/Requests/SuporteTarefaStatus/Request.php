<?php

namespace App\Http\Requests\SuporteTarefaStatus;

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
            'nome' => 'required|string|max:20|in:Aberto,Inconsistente,Solucionado,Recusado',
        ];
    }
    
    public function attributes()
    {
        return [
            'nome' => 'Nome',
        ];
    }
}
