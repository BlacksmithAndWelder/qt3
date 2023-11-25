<?php
use Tests\TestCase;
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListar()
    {
        // Usar DB::shouldReceive para simular uma consulta ao banco de dados
        DB::shouldReceive('table->get')->andReturn(collect([]));

        // Chamar a rota e verificar se a view é retornada
        $response = $this->get('aluno');
        $response->assertViewIs('aluno.listar');
        $response->assertStatus(200);
    }

    // Adicionar outros testes conforme necessário
}
