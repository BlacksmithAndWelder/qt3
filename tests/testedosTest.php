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
    
}
