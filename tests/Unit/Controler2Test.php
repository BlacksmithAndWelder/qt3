<?php

namespace Tests\Unit;
use Tests\Unit\Web\Suporte\SuporteTarefaControllerTest;

class SuporteTarefaControllerTest extends SuporteTarefaControllerTest
{
    // ... (códigos anteriores)

    public function testSalvarCriaNovaSuporteTarefaNoBancoDeDados()
    {
        // Crie instâncias mock para as classes SuporteTarefa, SuporteTarefaRequest, SuporteTarefaStatus e User
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaRequestMock = Mockery::mock(SuporteTarefaRequest::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);
        $userMock = Mockery::mock(User::class);

        // Defina as expectativas para as instâncias mock
        $suporteTarefaMock->shouldReceive('create')->andReturnSelf();

        // Crie uma instância do controlador com as instâncias mock
        $controller = new SuporteTarefaController($suporteTarefaMock, $suporteTarefaStatusMock, $userMock);

        // Execute a função 'salvar'
        $response = $controller->salvar($suporteTarefaRequestMock);

        // Verifique se a nova SuporteTarefa foi criada no banco de dados
        $this->assertDatabaseHas('suporte_tarefas', [
            // Adicione mais verificações conforme necessário
        ]);
    }

    public function testEditarAtualizaSuporteTarefaNoBancoDeDados()
    {
        // Crie instâncias mock para as classes SuporteTarefa, SuporteTarefaStatus e User
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);
        $userMock = Mockery::mock(User::class);

        // Crie e salve uma SuporteTarefa de exemplo no banco de dados
        $suporteTarefa = $suporteTarefaMock->create();

        // Defina as expectativas para as instâncias mock
        $suporteTarefaMock->shouldReceive('find')->andReturn($suporteTarefa);
        $suporteTarefaStatusMock->shouldReceive('get')->andReturn(collect([]));

        // Crie uma instância do controlador com as instâncias mock
        $controller = new SuporteTarefaController($suporteTarefaMock, $suporteTarefaStatusMock, $userMock);

        // Execute a função 'editar'
        $response = $controller->editar($suporteTarefa->id);

        // Verifique se a SuporteTarefa foi atualizada no banco de dados
        $this->assertDatabaseHas('suporte_tarefas', [
            'id' => $suporteTarefa->id,
            // Adicione mais verificações conforme necessário
        ]);
    }

    public function testExcluirRemoveSuporteTarefaDoBancoDeDados()
    {
        // Crie instâncias mock para as classes SuporteTarefa, SuporteTarefaStatus e User
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);
        $userMock = Mockery::mock(User::class);

        // Crie e salve uma SuporteTarefa de exemplo no banco de dados
        $suporteTarefa = $suporteTarefaMock->create();

        // Crie uma instância do controlador com as instâncias mock
        $controller = new SuporteTarefaController($suporteTarefaMock, $suporteTarefaStatusMock, $userMock);

        // Execute a função 'excluir'
        $response = $controller->excluir($suporteTarefa->id);

        // Verifique se a SuporteTarefa foi removida do banco de dados
        $this->assertDatabaseMissing('suporte_tarefas', ['id' => $suporteTarefa->id]);
    }

    // ... (função utilitária getValidSuporteTarefaRequest)
}
