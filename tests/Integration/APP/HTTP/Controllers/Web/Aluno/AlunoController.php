<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_alunos()
    {
        // Add some test data to the database
        Aluno::factory()->count(3)->create();

        // Make a request to the listar endpoint
        $response = $this->get(route('aluno.listar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('aluno.listar');
    }

    /** @test */
    public function it_can_show_the_create_aluno_form()
    {
        // Make a request to the criar endpoint
        $response = $this->get(route('aluno.criar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('aluno.criar');
    }

    // Add more test methods for other actions in AlunoController
}
