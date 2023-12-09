<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\SuporteTarefa\Request;

class SuporteTarefaRequestTest extends TestCase
{
    /** @test */
    public function it_has_correct_validation_rules()
    {
        $request = new Request();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'user_id'   => 'required',
            'status_id' => 'required',
            'urgente'   => 'required|boolean',
            'assunto'   => 'required|string',
            'descricao' => 'required|string',
        ], $request->rules());
    }

    /** @test */
    public function it_has_correct_attributes()
    {
        $request = new Request();

        $this->assertEquals([
            'user_id'   => 'Usuário',
            'status_id' => 'Status',
            'urgente'   => 'Urgente',
            'assunto'   => 'Assunto',
            'descricao' => 'Descrição',
        ], $request->attributes());
    }
}
