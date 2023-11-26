<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\User;
use App\Models\SuporteTarefaStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Tests\TestCase;

class SuporteTarefaControllerTest extends TestCase
{
    public function testCriarFunction()
    {
        // Criar instâncias mock para User e SuporteTarefaStatus
        $userMock = $this->createMock(User::class);
        $statusMock = $this->createMock(SuporteTarefaStatus::class);

        // Substituir as instâncias reais pelos mocks
        app()->instance(User::class, $userMock);
        app()->instance(SuporteTarefaStatus::class, $statusMock);

        // Chamar a rota que corresponde à função 'criar'
        $response = $this->get(route('suporte-tarefa.criar'));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.criar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.criar');
    }

    use RefreshDatabase;

    public function testListarFunction()
    {
        // Criar alguns dados mockados
        $mockedData = [
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
        ];

        // Criar um mock para SuporteTarefa
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configurar o mock para retornar os dados mockados quando 'get' for chamado
        $suporteTarefaMock::method('get')->willReturn($mockedData);

        // Substituir a implementação real pelo mock
        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);

        // Chamar a rota que corresponde à função 'listar'
        $response = $this->get(route('suporte-tarefa.listar'));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.listar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.listar');

        // Verificar se os dados mockados estão presentes na view
        $response->assertViewHas('ListaSuporteTarefa', $mockedData);
    }
    
}
