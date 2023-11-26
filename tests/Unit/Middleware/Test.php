<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Mock the SuporteTarefa model using Laravel's model mocking
        SuporteTarefa::shouldReceive('with')
            ->with(['usuario', 'status'])
            ->andReturnSelf();

        // Simulate a response with hardcoded values
        $mockedResponse = new Collection([
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
            // Add more mock data as needed
        ]);

        // Use Laravel's DB facade to mock the query builder for the SuporteTarefa model
        DB::shouldReceive('table')
            ->with('suporte_tarefas')
            ->andReturnSelf();

        DB::shouldReceive('get')->andReturn($mockedResponse);

        // Use Laravel's testing helpers to assert the view response
        $response = app(SuporteTarefaController::class)->listar();

        $response->assertViewIs('suporte-tarefa.listar');
        $response->assertViewHas('ListaSuporteTarefa', $mockedResponse->toArray());
    }
}
