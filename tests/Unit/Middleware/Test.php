<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Create a user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create SuporteTarefa instances directly
        $suporteTarefa1 = SuporteTarefa::create([
            'status_id' => 1,
            'user_id' => $user->id,
            'assunto' => 'Support Task 1',
            'descricao' => 'Description for Support Task 1',
            'urgente' => false,
        ]);

        $suporteTarefa2 = SuporteTarefa::create([
            'status_id' => 2,
            'user_id' => $user->id,
            'assunto' => 'Support Task 2',
            'descricao' => 'Description for Support Task 2',
            'urgente' => true,
        ]);

        // Mock the SuporteTarefa model using Laravel's model mocking
        SuporteTarefa::shouldReceive('with')
            ->with(['usuario', 'status'])
            ->andReturnSelf();

        // Use Laravel's testing helpers to assert the view response
        $response = app(SuporteTarefaController::class)->listar();

        // Assert that the view is correct and contains the expected data
        $response->assertViewIs('suporte-tarefa.listar');
        $response->assertViewHas('ListaSuporteTarefa', [$suporteTarefa1->toArray(), $suporteTarefa2->toArray()]);
    }
}