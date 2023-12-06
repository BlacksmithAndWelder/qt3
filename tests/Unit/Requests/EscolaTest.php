<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\Escola\Request as EscolaRequest;

class EscolaRequestTest extends TestCase
{
    public function testValidationRules()
    {
        $request = new EscolaRequest();

        $this->assertTrue($request->authorize()); // Ensure authorization is true

        $rules = $request->rules();

        $this->assertArrayHasKey('nome', $rules);
        $this->assertArrayHasKey('endereco', $rules);
        $this->assertArrayHasKey('pais', $rules);
        $this->assertArrayHasKey('max_alunos', $rules);
        $this->assertArrayHasKey('segmento', $rules);

        $this->assertEquals('required|max:256', $rules['nome']);
        $this->assertEquals('string|nullable', $rules['endereco']);
        $this->assertEquals('string|max:256', $rules['pais']);
        $this->assertEquals('numeric', $rules['max_alunos']);
        $this->assertEquals('required', $rules['segmento']);
    }

    public function testAttributes()
    {
        $request = new EscolaRequest();

        $attributes = $request->attributes();

        $this->assertEquals('Nome', $attributes['nome']);
        $this->assertEquals('Segmento', $attributes['segmento']);
        $this->assertEquals('Endereço', $attributes['endereco']);
        $this->assertEquals('País', $attributes['pais']);
        $this->assertEquals('Quantidade máxima de alunos', $attributes['max_alunos']);
    }
}
