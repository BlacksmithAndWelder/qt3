<?php

namespace Tests\Unit\Controllers\Web\Suporte;

use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Http\Requests\SuporteTarefa\Request as SuporteTarefaRequest;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class SuporteTarefaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        $suporteTarefaController = new SuporteTarefaController();

        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('with')->with(['usuario', 'status'])->andReturn($suporteTarefaMock);
        $suporteTarefaMock->shouldReceive('get')->andReturn(collect());

        $this->assertInstanceOf(View::class, $suporteTarefaController->listar());
    }

    public function testCriar()
    {
        $suporteTarefaController = new SuporteTarefaController();

        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $usuarioMock = Mockery::mock(User::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);

        $usuarioMock->shouldReceive('get')->andReturn(collect());
        $suporteTarefaStatusMock->shouldReceive('get')->andReturn(collect());

        $this->assertInstanceOf(View::class, $suporteTarefaController->criar());
    }

    public function testSalvar()
    {
        $suporteTarefaController = new SuporteTarefaController();

        $requestMock = Mockery::mock(SuporteTarefaRequest::class);
        $usuarioMock = Mockery::mock(User::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);

        $usuarioMock->shouldReceive('find')->andReturn($usuarioMock);
        $suporteTarefaStatusMock->shouldReceive('find')->andReturn($suporteTarefaStatusMock);

        $requestMock->shouldReceive('validated')->andReturn([
            'user_id' => 1,
            'status_id' => 1,
            'urgente' => true,
            'assunto' => 'Assunto Teste',
            'descricao' => 'Descrição Teste',
        ]);

        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('create')->andReturn($suporteTarefaMock);

        $this->assertInstanceOf(RedirectResponse::class, $suporteTarefaController->salvar($requestMock));
    }

    // Adicione mais testes para as outras funções do controlador conforme necessário
}
