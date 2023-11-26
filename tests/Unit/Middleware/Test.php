<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Database\Factories\UserFactory;

class SuporteTarefaControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Load the model factories
        $this->withFactories(__DIR__.'/database/factories');
    }

    public function testListarFunction()
    {
        // Use the UserFactory to create instances of User with predefined values
        $user = UserFactory::new()->create();

        // Use Laravel's model factory to create instances with predefined values
        $mockedResponse = factory(SuporteTarefa::class, 2)->create(['user_id' => $user->id]);

        // Mock the SuporteTarefa model using Laravel's model mocking
        SuporteTarefa::shouldReceive('with')
            ->with(['usuario', 'status'])
            ->andReturnSelf();

        // Use Laravel's testing helpers to assert the view response
        $response = app(SuporteTarefaController::class)->listar();

        $response->assertViewIs('suporte-tarefa.listar');
        $response->assertViewHas('ListaSuporteTarefa', $mockedResponse->toArray());
    }
}