<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\Aluno\Request;

class AlunoRequestTest extends TestCase
{
    /** @test */
    public function it_has_correct_validation_rules()
    {
        $request = new Request();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'nome'          => 'string|required|max:256',
            'sobrenome'     => 'string|required|max:256',
            'idade'         => 'required|numeric',
            'bolsa_estudos' => 'required|boolean',
            'turma_id'      => 'required|numeric',
        ], $request->rules());
    }

    /** @test */
    public function it_has_correct_attributes()
    {
        $request = new Request();

        $this->assertEquals([
            'nome'          => 'Nome',
            'sobrenome'     => 'Sobrenome',
            'idade'         => 'Idade',
            'bolsa_estudos' => 'Bolsa de Estudos',
            'turma_id'      => 'Turma',
        ], $request->attributes());
    }
}
