<?php

namespace Tests\Feature;

use App\Http\Controllers\Web\Aluno\AlunoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Aluno;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the listar route returns a 200 status code.
     *
     * @return void
     */
    public function testListarRoute()
    {
        // Create mock Aluno data
        $mockedAlunos = [
            new Aluno([
                'nome' => 'John Doe',
                'sobrenome' => 'Doe',
                'idade' => 25,
                'bolsa_estudos' => true,
                'turma_id' => 1,
            ]),
            // Add more mock Aluno instances as needed
        ];

        // Mock the Aluno model
        $alunoModelMock = $this->getMockBuilder(Aluno::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock the AlunoController to return the mocked data
        $alunoControllerMock = $this->getMockBuilder(AlunoController::class)
            ->disableOriginalConstructor()
            ->getMock();

        $alunoControllerMock->method('listar')
            ->willReturn($mockedAlunos);

        // Replace the actual model and controller instances with the mocked ones
        $this->app->instance(Aluno::class, $alunoModelMock);
        $this->app->instance(AlunoController::class, $alunoControllerMock);

        // Make a request to the route
        $response = $this->get('aluno');

        // Assert that the response contains the mocked data
        foreach ($mockedAlunos as $aluno) {
            $response->assertSee($aluno->nome);
            // Add assertions for other attributes as needed
        }

        // Assert the status code is 200
        $response->assertStatus(200);
    }
}
