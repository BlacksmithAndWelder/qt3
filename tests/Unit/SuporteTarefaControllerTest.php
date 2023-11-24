<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuporteTarefaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListar()
    {
        // Mock SuporteTarefa model
        $suporteTarefaMock = $this->mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('with')->andReturnSelf();
        $suporteTarefaMock->shouldReceive('get')->andReturn([]);

        // Expect a view with specified data
        $this->expectsView('suporte-tarefa.listar', ['ListaSuporteTarefa' => []]);

        // Call the listar method
        $response = $this->get(route('suporte-tarefa.listar'));

        // Assertions
        $response->assertStatus(200);
    }

    public function testCriar()
    {
        // Mock SuporteTarefa, Usuario, and SuporteTarefaStatus models
        $suporteTarefaMock = $this->mock(SuporteTarefa::class);
        $usuarioMock = $this->mock(Usuario::class);
        $suporteTarefaStatusMock = $this->mock(SuporteTarefaStatus::class);

        // Mock get method for ListaUsuarios and ListaSuporteTarefaStatus
        $usuarioMock->shouldReceive('get')->andReturn([]);
        $suporteTarefaStatusMock->shouldReceive('get')->andReturn([]);

        // Expect a view with specified data
        $this->expectsView('suporte-tarefa.criar', [
            'SuporteTarefa' => new SuporteTarefa(),
            'ListaSuporteTarefaStatus' => [],
            'ListaUsuarios' => [],
        ]);

        // Call the criar method
        $response = $this->get(route('suporte-tarefa.criar'));

        // Assertions
        $response->assertStatus(200);
    }

    public function testSalvar()
    {
        // Mock Usuario and SuporteTarefaStatus models
        $usuarioMock = $this->mock(Usuario::class);
        $suporteTarefaStatusMock = $this->mock(SuporteTarefaStatus::class);

        // Mock SuporteTarefa create method
        $suporteTarefaMock = $this->mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('create')->andReturn(new SuporteTarefa());

        // Call the salvar method with valid data
        $response = $this->post(route('suporte-tarefa.salvar'), [
            'user_id' => 1,
            'status_id' => 1,
            'urgente' => false,
            'assunto' => 'Teste',
            'descricao' => 'Descrição do teste',
        ]);

        // Assertions
        $response->assertRedirect(route('suporte-tarefa.listar'));
        $this->assertDatabaseHas('suporte_tarefas', ['assunto' => 'Teste']);
    }

    public function testEditar()
    {
        // Mock SuporteTarefa, Usuario, and SuporteTarefaStatus models
        $suporteTarefaMock = $this->mock(SuporteTarefa::class);
        $usuarioMock = $this->mock(Usuario::class);
        $suporteTarefaStatusMock = $this->mock(SuporteTarefaStatus::class);

        // Mock find methods for SuporteTarefa and where methods for ListaUsuarios and ListaSuporteTarefaStatus
        $suporteTarefaMock->shouldReceive('find')->andReturn(new SuporteTarefa());
        $usuarioMock->shouldReceive('get')->andReturn([]);
        $suporteTarefaStatusMock->shouldReceive('get')->andReturn([]);

        // Expect a view with specified data
        $this->expectsView('suporte-tarefa.editar', [
            'SuporteTarefa' => new SuporteTarefa(),
            'ListaSuporteTarefaStatus' => [],
            'ListaUsuarios' => [],
        ]);

        // Call the editar method with a valid ID
        $response = $this->get(route('suporte-tarefa.editar', 1));

        // Assertions
        $response->assertStatus(200);
    }

    public function testAtualizar()
    {
        // Mock Usuario and SuporteTarefaStatus models
        $usuarioMock = $this->mock(Usuario::class);
        $suporteTarefaStatusMock = $this->mock(SuporteTarefaStatus::class);

        // Mock find method for SuporteTarefa and where method for ListaUsuarios and ListaSuporteTarefaStatus
        $suporteTarefaMock = $this->mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('find')->andReturn(new SuporteTarefa());
        $usuarioMock->shouldReceive('get')->andReturn([]);
        $suporteTarefaStatusMock->shouldReceive('get')->andReturn([]);

        // Mock save method for SuporteTarefa
        $suporteTarefaMock->shouldReceive('save');

        // Call the atualizar method with valid data and ID
        $response = $this->put(route('suporte-tarefa.atualizar', 1), [
            'user_id' => 1,
            'status_id' => 1,
            'urgente' => false,
            'assunto' => 'Teste Atualizado',
            'descricao' => 'Descrição atualizada',
        ]);

        // Assertions
        $response->assertRedirect(route('suporte-tarefa.listar'));
        $this->assertDatabaseHas('suporte_tarefas', ['assunto' => 'Teste Atualizado']);
    }

    public function testExcluir()
    {
        // Mock SuporteTarefa model
        $suporteTarefaMock = $this->mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('find')->andReturn(new SuporteTarefa());
        $suporteTarefaMock->shouldReceive('delete');

        // Call the excluir method with a valid ID

