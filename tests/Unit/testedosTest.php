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

        // Criar um mock manual da classe SuporteTarefa
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Definir a expectativa para o método with
        $suporteTarefaMock->expects($this->once())
            ->method('with')
            ->willReturnSelf();

        // Definir a expectativa para o método get
        $suporteTarefaMock->expects($this->once())
            ->method('get')
            ->willReturn(collect($mockedTarefas));

        // Substituir a implementação real de SuporteTarefa usando o mock manual
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
}
