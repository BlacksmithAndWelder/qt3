<?php
use Tests\TestCase;
use App\Http\Requests\Turma\Request as TurmaRequest;
use App\Models\Escola;
use App\Models\Turma;
use Illuminate\Foundation\Testing\WithFaker;

class TurmaControllerTest extends TestCase
{
    use WithFaker;

    public function testCriar()
    {
        $response = $this->get('/turma/criar');

        $response->assertStatus(200);
        $response->assertViewIs('turma.criar');
    }

    public function testSalvar()
    {
        // Crie um mock para a classe Escola
        $escolaMock = $this->getMockBuilder(Escola::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Faça com que o mock responda como uma escola de exemplo
        $escolaMock->method('find')->willReturn(Escola::factory()->create());

        $this->app->instance(Escola::class, $escolaMock);

        // Dados de exemplo para a requisição
        $dados = [
            'escola_id' => $this->faker->randomDigit,
            'ativo' => true,
            'equipe' => 'Equipe A',
            'sala' => 'Sala 101',
        ];

        $response = $this->post('/turma/salvar', $dados);

        $response->assertRedirect('/turma/listar');
    }

    // ... Outros métodos de teste
}
