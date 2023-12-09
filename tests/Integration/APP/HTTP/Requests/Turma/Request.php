<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\Turma\Request;

class TurmaRequestTest extends TestCase
{
    /** @test */
    public function it_has_correct_validation_rules()
    {
        $request = new Request();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'escola_id'   => 'required',
            'ativo'       => 'boolean',
            'equipe'      => 'required|string|in:A,B,C,D',
            'sala'        => 'required|numeric|in:1,2,3,4',
        ], $request->rules());
    }

    /** @test */
    public function it_has_correct_attributes()
    {
        $request = new Request();

        $this->assertEquals([
            'escola_id'   => 'Escola',
            'ativo'       => 'Ativo',
            'equipe'      => 'Equipe',
            'sala'        => 'Sala',
        ], $request->attributes());
    }
}
