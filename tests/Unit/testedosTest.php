<?php

use App\Http\Requests\SuporteTarefa\Request;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class SuporteTarefaRequestTest extends TestCase
{
    public function testRulesWithValidData()
    {
        // Mock da classe Request
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['input'])
            ->getMock();

        // Substituir a implementação da função input para fornecer dados válidos
        $request->method('input')->willReturnMap([
            ['user_id', 1],
            ['status_id', 2],
            ['urgente', true],
            ['assunto', 'Assunto de teste'],
            ['descricao', 'Descrição de teste'],
        ]);

        // Chamar a função rules e verificar se não há exceção lançada
        $this->assertNull($request->rules());
    }

    public function testRulesWithInvalidData()
    {
        // Mock da classe Request
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['input'])
            ->getMock();

        // Substituir a implementação da função input para fornecer dados inválidos
        $request->method('input')->willReturnMap([
            ['user_id', 1],
            ['status_id', 2],
            ['urgente', true],
            ['descricao', 'Descrição de teste'],
        ]);

        // Chamar a função rules e verificar se uma exceção de validação é lançada
        $this->expectException(ValidationException::class);
        $request->rules();
    }

    // Adicione mais testes conforme necessário
}
