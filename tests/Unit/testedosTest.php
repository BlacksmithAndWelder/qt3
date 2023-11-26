<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use Mockery\MockInterface;
use Tests\TestCase;

class STCTest extends TestCase
{
    public function testListarFunction()
    {
        // Criar uma coleção de tarefas mockadas
        $mockedTarefas = [
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
        ];

        // Criar um mock específico para a classe SuporteTarefa
        $suporteTarefaMock = \Mockery::mock(SuporteTarefa::class, function (MockInterface $mock) use ($mockedTarefas) {
            $mock->shouldReceive('with')->andReturnSelf();
            $mock->shouldReceive('get')->andReturn(collect($mockedTarefas));
        });

        // Substituir a implementação real pelo mock
        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);

        // Chamar a rota que corresponde à função 'listar'
        $response = $this->get(route('suporte-tarefa.listar'));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.listar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.listar');

        // Verificar se os dados das tarefas mockadas estão presentes na view
        $response->assertViewHas('ListaSuporteTarefa', $mockedTarefas);
    }

    // Liberar os recursos do Mockery após o teste
    protected function tearDown(): void
    {
        \Mockery::close();
    }
}
