<?php
use Tests\TestCase;
use App\Http\Requests\Escola\Request as EscolaRequest;

class EscolaRequestTest extends TestCase
{
    public function testAuthorizeRetornaTrue()
    {
        $escolaRequest = new EscolaRequest();
        $this->assertTrue($escolaRequest->authorize());
    }

    public function testRules()
    {
        $escolaRequest = new EscolaRequest();
        $rules = $escolaRequest->rules();

        $this->assertArrayHasKey('nome', $rules);
        $this->assertArrayHasKey('endereco', $rules);
        $this->assertArrayHasKey('pais', $rules);
        $this->assertArrayHasKey('max_alunos', $rules);
        $this->assertArrayHasKey('segmento', $rules);

        $this->assertContains('required', $rules['nome']);
        $this->assertContains('string', $rules['endereco']);
        $this->assertContains('nullable', $rules['endereco']);
        $this->assertContains('string', $rules['pais']);
        $this->assertContains('numeric', $rules['max_alunos']);
        $this->assertContains('required', $rules['segmento']);
    }

    public function testAttributes()
    {
        $escolaRequest = new EscolaRequest();
        $attributes = $escolaRequest->attributes();

        $this->assertArrayHasKey('nome', $attributes);
        $this->assertArrayHasKey('endereco', $attributes);
        $this->assertArrayHasKey('pais', $attributes);
        $this->assertArrayHasKey('max_alunos', $attributes);
        $this->assertArrayHasKey('segmento', $attributes);

        $this->assertEquals('Nome', $attributes['nome']);
        $this->assertEquals('Endereço', $attributes['endereco']);
        $this->assertEquals('País', $attributes['pais']);
        $this->assertEquals('Quantidade máxima de alunos', $attributes['max_alunos']);
        $this->assertEquals('Segmento', $attributes['segmento']);
    }
}
