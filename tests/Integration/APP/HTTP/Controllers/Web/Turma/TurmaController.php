<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Escola;
use App\Models\Turma;

class TurmaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_turmas()
    {
        // Add some test data to the database
        Turma::factory()->count(3)->create();

        // Make a request to the listar endpoint
        $response = $this->get(route('turma.listar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('turma.listar');
    }

    /** @test */
    public function it_can_show_the_create_turma_form()
    {
        // Make a request to the criar endpoint
        $response = $this->get(route('turma.criar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('turma.criar');
    }

    /** @test */
    public function it_can_create_a_new_turma()
    {
        // Mock data for creating a new turma
        $data = [
            'escola_id' => Escola::factory()->create()->id,
            'ativo' => true,
            'equipe' => 'Test Equipe',
            'sala' => 'Test Sala',
        ];

        // Make a request to the salvar endpoint with the mock data
        $response = $this->post(route('turma.salvar'), $data);

        // Assert a successful response and that the turma is created
        $response->assertRedirect(route('turma.listar'));
        $this->assertDatabaseHas('turmas', $data);
    }

    /** @test */
    public function it_can_show_the_edit_turma_form()
    {
        // Add a turma test data to the database
        $turma = Turma::factory()->create();

        // Make a request to the editar endpoint
        $response = $this->get(route('turma.editar', $turma->id));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('turma.editar');
    }

    /** @test */
    public function it_can_update_an_existing_turma()
    {
        // Add a turma test data to the database
        $turma = Turma::factory()->create();

        // Mock data for updating the turma
        $data = [
            'escola_id' => Escola::factory()->create()->id,
            'ativo' => false,
            'equipe' => 'Updated Equipe',
            'sala' => 'Updated Sala',
        ];

        // Make a request to the atualizar endpoint with the mock data
        $response = $this->put(route('turma.atualizar', $turma->id), $data);

        // Assert a successful response and that the turma is updated
        $response->assertRedirect(route('turma.listar'));
        $this->assertDatabaseHas('turmas', $data);
    }

    /** @test */
    public function it_can_delete_an_existing_turma()
    {
        // Add a turma test data to the database
        $turma = Turma::factory()->create();

        // Make a request to the excluir endpoint
        $response = $this->delete(route('turma.excluir', $turma->id));

        // Assert a successful response and that the turma is deleted
        $response->assertRedirect(route('turma.listar'));
        $this->assertDatabaseMissing('turmas', ['id' => $turma->id]);
    }
}
