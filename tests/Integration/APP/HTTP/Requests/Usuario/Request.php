<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\Usuario\Request;

class UsuarioRequestIntTest extends TestCase
{
    /** @test */
    public function it_has_correct_validation_rules()
    {
        $request = new Request();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'nome' => 'required',
            'senha' => 'required',
            'email' => 'required',
        ], $request->rules());
    }

    /** @test */
    public function it_has_correct_attributes()
    {
        $request = new Request();

        $this->assertEquals([
            'nome' => 'Nome',
            'senha' => 'Senha',
            'email' => 'Email',
        ], $request->attributes());
    }
}
