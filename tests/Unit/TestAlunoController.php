<?php


namespace Tests\Unit\Web\Aluno;

use Tests\TestCase;
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AlunoControllerTest extends TestCase
{
    /**
     * @codeCoverageIgnore
     */
    public function testListar()
    {
        // Criar um mock para a classe Aluno
        $alunoMock = $this->createMock(Aluno::class);

        // Configurar o mock para retornar uma coleção de alunos
        $alunoMock->method('get')
            ->willReturn(collect());

        // Criar uma instância do controlador AlunoController
        $controller = new AlunoController($alunoMock);

        // Chamar a função listar e verificar o retorno
        $result = $controller->listar();
        $this->assertInstanceOf(View::class, $result);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testCriar()
    {
        // Criar mocks para as classes Aluno e Turma
        $alunoMock = $this->createMock(Aluno::class);
        $turmaMock = $this->createMock(Turma::class);

        // Configurar o mock de Turma para retornar uma coleção de turmas
        $turmaMock->method('where')
            ->willReturn($turmaMock);
        $turmaMock->method('get')
            ->willReturn(collect());

        // Criar uma instância do controlador AlunoController
        $controller = new AlunoController($alunoMock, $turmaMock);

        // Chamar a função criar e verificar o retorno
        $result = $controller->criar();
        $this->assertInstanceOf(View::class, $result);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testSalvar()
    {
        // Criar mocks para as classes Aluno, Turma e AlunoRequest
        $alunoMock = $this->createMock(Aluno::class);
        $turmaMock = $this->createMock(Turma::class);
        $requestMock = $this->createMock(AlunoRequest::class);

        // Configurar o mock de AlunoRequest para retornar dados validados
        $requestMock->method('validated')
            ->willReturn([
                'nome' => 'John Doe',
                'sobrenome' => 'Doe',
                'idade' => 25,
                'bolsa_estudos' => true,
                'turma_id' => 1,
            ]);

        // Configurar mocks para Turma e Aluno
        $turmaMock->method('find')
            ->willReturn($turmaMock);
        $alunoMock->method('create')
            ->willReturn($alunoMock);

        // Criar uma instância do controlador AlunoController
        $controller = new AlunoController($alunoMock, $turmaMock);

        // Chamar a função salvar e verificar o redirecionamento
        $result = $controller->salvar($requestMock);
        $this->assertInstanceOf(RedirectResponse::class, $result);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testEditar()
    {
        // Criar mocks para as classes Aluno e Turma
        $alunoMock = $this->createMock(Aluno::class);
        $turmaMock = $this->createMock(Turma::class);

        // Configurar mocks para Aluno e Turma
        $alunoMock->method('with')
            ->willReturn($alunoMock);
        $turmaMock->method('where')
            ->willReturn($turmaMock);
        $turmaMock->method('get')
            ->willReturn(collect());

        // Criar uma instância do controlador AlunoController
        $controller = new AlunoController($alunoMock, $turmaMock);

        // Chamar a função editar e verificar o retorno
        $result = $controller->editar(1);
        $this->assertInstanceOf(View::class, $result);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testAtualizar()
    {
        // Criar mocks para as classes Aluno, Turma e AlunoRequest
        $alunoMock = $this->createMock(Aluno::class);
        $turmaMock = $this->createMock(Turma::class);
        $requestMock = $this->createMock(AlunoRequest::class);

        // Configurar mocks para Aluno, Turma e AlunoRequest
        $alunoMock->method('find')
            ->willReturn($alunoMock);
        $turmaMock->method('find')
            ->willReturn($turmaMock);
        $requestMock->method('validated')
            ->willReturn([
                'nome' => 'John Doe',
                'sobrenome' => 'Doe',
                'idade' => 25,
                'bolsa_estudos' => true,
                'turma_id' => 1,
            ]);

        // Criar uma instância do controlador AlunoController
        $controller = new AlunoController($alunoMock, $turmaMock);

        // Chamar a função atualizar e verificar o redirecionamento
        $result = $controller->atualizar($requestMock, 1);
        $this->assertInstanceOf(RedirectResponse::class, $result);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testExcluir()
    {
        // Criar mocks para as classes Aluno e Turma
        $alunoMock = $this->createMock(Aluno::class);

        // Configurar mock para Aluno
        $alunoMock->method('find')
            ->willReturn($alunoMock);
        $alunoMock->method('delete');

        // Criar uma instância do controlador AlunoController
        $controller = new AlunoController($alunoMock);

        // Chamar a função excluir e verificar o redirecionamento
        $result = $controller->excluir(1);
        $this->assertInstanceOf(RedirectResponse::class, $result);
    }
}
