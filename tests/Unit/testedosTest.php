<?php
use Tests\TestCase;
use App\Http\Requests\Turma\Request as TurmaRequest;
use App\Models\Escola;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;

class TurmaControllerTest extends TestCase
{
    use WithFaker;

    public function testSalvar()
    {
        // Mock do método find da facade DB
        DB::shouldReceive('table->find')->andReturn((object) Escola::factory()->create()->toArray());

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
