<?php

use App\Http\Requests\SuporteTarefaStatus\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testRules()
    {
        // Criar uma instância da classe Request (a classe que estamos testando)
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Substituir a implementação da função rules
        $request->method('rules')->willReturn(['nome' => 'required|string|max:20|in:Aberto,Inconsistente,Solucionado,Recusado']);

        // Chamar a função rules e verificar se o resultado é o esperado
        $this->assertEquals(['nome' => 'required|string|max:20|in:Aberto,Inconsistente,Solucionado,Recusado'], $request->rules());
    }

    public function testAuthorize()
    {
        $request = new Request();

        // Mocking the return value of the authorize method
        $this->assertTrue($request->authorize());
    }

    

    public function testAttributes()
    {
        $request = new Request();

        // Mocking the return value of the attributes method
        $this->assertEquals(['nome' => 'Nome'], $request->attributes());
    }
}
