<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\Escola;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscolaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_escolas()
    {
        // Add some test data to the database
        Escola::factory()->count(3)->create();

        // Make a request to the listar endpoint
        $response = $this->get(route('escola.listar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('escola.listar');
    }

    /** @test */
    public function it_can_show_the_create_escola_form()
    {
        // Make a request to the criar endpoint
        $response = $this->get(route('escola.criar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('escola.criar');
    }

    /** @test */
    public function it_can_create_a_new_escola()
    {
        // Mock data for creating a new escola
        $data = [
            'nome' => 'Escola Teste',
            'segmento' => 'Ensino Fundamental',
            'endereco' => 'Rua Teste, 123',
            'pais' => 'Brasil',
            'max_alunos' => 500,
        ];

        // Make a request to the salvar endpoint with the mock data
        $response = $this->post(route('escola.salvar'), $data);

        // Assert a successful response and that the escola is created
        $response->assertRedirect(route('escola.listar'));
        $this->assertDatabaseHas('escolas', $data);
    }

    // Add more test methods for other actions in EscolaController
}
