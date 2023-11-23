<?php

namespace Tests\Unit\Controllers\Web\Aluno;

use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class AlunoControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        $alunoController = new AlunoController();

        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('get')->andReturn(collect());

        $this->assertInstanceOf(View::class, $alunoController->listar());
    }

    public function testCriar()
    {
        $alunoController = new AlunoController();

        $alunoMock = Mockery::mock(Aluno::class);
        $turmaMock = Mockery::mock(Turma::class);

        $turmaMock->shouldReceive('where')->with('ativo', true)->andReturn($turmaMock);
        $turmaMock->shouldReceive('get')->andReturn(collect());

        $this->assertInstanceOf(View::class, $alunoController->criar());
    }

    public function testSalvar()
    {
        $alunoController = new AlunoController();

        $requestMock = Mockery::mock(AlunoRequest::class);
        $turmaMock = Mockery::mock(Turma::class);

        $turmaMock->shouldReceive('find')->andReturn($turmaMock);

        $requestMock->shouldReceive('validated')->andReturn([
            'nome' => 'Nome Teste',
            'sobrenome' => 'Sobrenome Teste',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('create')->andReturn($alunoMock);

        $this->assertInstanceOf(RedirectResponse::class, $alunoController->salvar($requestMock));
    }

    // A   dicione mais testes para as outras funções do controlador conforme necessário
}
