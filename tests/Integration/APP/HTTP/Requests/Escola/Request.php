<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\Escola\Request;

class EscolaRequestTest extends TestCase
{
    /** @test */
    public function it_has_correct_validation_rules()
    {
        $request = new Request();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'nome'        => 'required|max:256',
            'endereco'    => 'string|nullable',
            'pais'        => 'string|max:256',
            'max_alunos'  => 'numeric',
            'segmento'    => 'required',
        ], $request->rules());
    }

    /** @test */
    public function it_has_correct_attributes()
    {
        $request = new Request();

        $this->assertEquals([
            'nome'          => 'Nome',
            'segmento'      => 'Segmento',
            'endereco'      => 'Endereço',
            'pais'          => 'País',
            'max_alunos'    => 'Quantidade máxima de alunos',
        ], $request->attributes());
    }
}
