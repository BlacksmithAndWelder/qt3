<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Models\Aluno;
use App\Models\Turma;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\Factory as ViewFactory;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListar()
    {
        // Crie uma instância da classe AlunoController
        $alunoController = $this->getMockBuilder(AlunoController::class)
            ->onlyMethods(['listar'])
            ->getMock();

        // Defina o comportamento esperado para o método 'listar'
        $alunoController->expects($this->once())
            ->method('listar')
            ->willReturn(new View('aluno.listar'));

        // Chame o método 'listar' e verifique se a view é retornada
        $response = $alunoController->listar();
        $this->assertInstanceOf(View::class, $response);
    }

    public function testCriar()
    {
        // Crie uma instância da classe AlunoController
        $alunoController = $this->getMockBuilder(AlunoController::class)
            ->onlyMethods(['criar'])
            ->getMock();

        // Defina o comportamento esperado para o método 'criar'
        $alunoController->expects($this->once())
            ->method('criar')
            ->willReturn(new View('aluno.criar'));

        // Chame o método 'criar' e verifique se a view é retornada
        $response = $alunoController->criar();
        $this->assertInstanceOf(View::class, $response);
    }

    public function testSalvar()
    {
        // Crie uma instância da classe AlunoController
        $alunoController = $this->getMockBuilder(AlunoController::class)
            ->onlyMethods(['salvar'])
            ->getMock();

        // Crie um mock para o request AlunoRequest
        $requestMock = $this->createMock(AlunoRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn([]);

        // Crie um mock para o model Aluno
        $alunoMock = $this->createMock(Aluno::class);
        $alunoMock->expects($this->once())
            ->method('create')
            ->willReturn($this->createMock(Aluno::class));

        // Substitua as instâncias reais pelos mocks
        $this->app->instance(Aluno::class, $alunoMock);

        // Chame o método 'salvar' e verifique se é redirecionado corretamente
        $response = $alunoController->salvar($requestMock);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    // Adicione mais testes para as outras funções do controlador conforme necessário
}
