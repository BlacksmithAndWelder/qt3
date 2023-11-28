<?php

use App\Http\Controllers\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class AlunoControllerTest extends TestCase
{
    public function testCreateAlunoWithValidData()
    {
        $request = $this->createMock(AlunoRequest::class);
        $request->method('all')->willReturn([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $controller = new AlunoController();
        $response = $controller->createAluno($request);

        $this->assertEquals(200, $response->getStatusCode());
        // Adicione mais asserções conforme necessário
    }

    public function testCreateAlunoWithInvalidData()
    {
        $request = $this->createMock(AlunoRequest::class);
        $request->method('all')->willReturn([
            // Dados inválidos, por exemplo, falta o nome
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $this->expectException(ValidationException::class);

        $controller = new AlunoController();
        $controller->createAluno($request);
    }

    public function testCreateAlunoWithDatabaseError()
    {
        $request = $this->createMock(AlunoRequest::class);
        $request->method('all')->willReturn([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $mockedDatabase = $this->createMock(Database::class);
        $mockedDatabase->method('insert')->willReturn(false);

        $controller = new AlunoController($mockedDatabase);
        
        $this->expectException(DatabaseException::class);
        $controller->createAluno($request);
    }
}
