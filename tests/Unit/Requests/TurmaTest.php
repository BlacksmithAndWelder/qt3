<?php

namespace Tests\Unit\Requests\Turma;

use Tests\TestCase;
use App\Http\Requests\Turma\Request;

class TurmaRequestTest extends TestCase
{
    public function testValidationRules()
    {
        $request = new Request();

        $this->assertEquals([
            'escola_id' => 'required',
            'ativo' => 'boolean',
            'equipe' => 'required|string|in:A,B,C,D',
            'sala' => 'required|numeric|in:1,2,3,4',
        ], $request->rules());
    }

    public function testAttributes()
    {
        $request = new Request();

        $this->assertEquals([
            'escola_id' => 'Escola',
            'ativo' => 'Ativo',
            'equipe' => 'Equipe',
            'sala' => 'Sala',
        ], $request->attributes());
    }
}
