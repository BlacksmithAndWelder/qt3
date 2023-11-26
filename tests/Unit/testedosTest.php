<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class STCTest extends TestCase
{
    public function testListarFunction()
    {
        // Criar uma coleção de tarefas mockadas
        $mockedTarefas = [
            ['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1'],
            ['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2'],
        ];

        // Configurar uma consulta simulada usando a fachada DB
        DB::shouldReceive('table')
            ->with('suporte_tarefas')
            ->once()
            ->andReturnSelf();

        DB::shouldReceive('get')
            ->once()
            ->andReturn(collect($mockedTarefas));

        // Chamar a rota que corresponde à função 'listar'
        $response = $this->get(route('suporte-tarefa.listar'));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.listar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.listar');

        // Verificar se os dados das tarefas mockadas estão presentes na view
        $response->assertViewHas('ListaSuporteTarefa', $mockedTarefas);
    }
}
