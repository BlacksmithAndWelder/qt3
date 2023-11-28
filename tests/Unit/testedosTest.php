<?php

use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Validation\ValidationException;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class AlunoControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateAlunoWithValidData()
    {
        $request = Mockery::mock(AlunoRequest::class);
        $request->shouldReceive('validated')->andReturn([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $controller = new AlunoController();
        $response = $controller->salvar($request);

        $this->assertEquals(302, $response->getStatusCode());
        // Adicione mais asserções conforme necessário
    }

    public function testCreateAlunoWithInvalidData()
    {
        $request = Mockery::mock(AlunoRequest::class);
        $request->shouldReceive('validated')->andReturn([
            // Dados inválidos, por exemplo, falta o nome
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $this->expectException(ValidationException::class);

        $controller = new AlunoController();
        $controller->salvar($request);
    }

    public function testCreateAlunoWithDatabaseError()
    {
        $request = Mockery::mock(AlunoRequest::class);
        $request->shouldReceive('validated')->andReturn([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $controller = new AlunoController();

        // Mock do método create da classe Aluno
        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('create')->andReturnUsing(
            function ($attributes) {
                // Simulando um erro de banco de dados
                return $attributes['nome'] === 'Erro' ? false : true;
            }
        );

        // Substitui o método create do Aluno pelo mock criado acima
        $this->app->instance(Aluno::class, $alunoMock);

        $this->expectException(\Exception::class);
        $controller->salvar($request);
    }
}
