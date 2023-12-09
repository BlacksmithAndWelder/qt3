<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;

class SuporteTarefaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_suporte_tarefas()
    {
        // Add some test data to the database
        SuporteTarefa::factory()->count(3)->create();

        // Make a request to the listar endpoint
        $response = $this->get(route('suporte-tarefa.listar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('suporte-tarefa.listar');
    }

    /** @test */
    public function it_can_show_the_create_suporte_tarefa_form()
    {
        // Make a request to the criar endpoint
        $response = $this->get(route('suporte-tarefa.criar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('suporte-tarefa.criar');
    }

    /** @test */
    public function it_can_create_a_new_suporte_tarefa()
    {
        // Mock data for creating a new suporte tarefa
        $data = [
            'user_id' => Usuario::factory()->create()->id,
            'status_id' => SuporteTarefaStatus::factory()->create()->id,
            'urgente' => false,
            'assunto' => 'Test Subject',
            'descricao' => 'Test Description',
        ];

        // Make a request to the salvar endpoint with the mock data
        $response = $this->post(route('suporte-tarefa.salvar'), $data);

        // Assert a successful response and that the suporte tarefa is created
        $response->assertRedirect(route('suporte-tarefa.listar'));
        $this->assertDatabaseHas('suporte_tarefas', $data);
    }

    // Add more test methods for other actions in SuporteTarefaController
}
