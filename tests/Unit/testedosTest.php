<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class STCTest extends TestCase
{
    public function testListarFunction()
    {
        // Criar uma resposta mock do banco de dados
        $mockedTarefas = [
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
        ];

        // Definir temporariamente um método shouldReceive para o teste
        SuporteTarefa::macro('shouldReceive', function ($method) {
            return $this;
        });

        // Substituir a implementação real de SuporteTarefa usando shouldReceive
        SuporteTarefa::shouldReceive('with')
            ->andReturnSelf();

        SuporteTarefa::shouldReceive('get')
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
