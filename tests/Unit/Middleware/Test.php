<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Simulate a response with hardcoded values
        $mockedResponse = new Collection([
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
            // Add more mock data as needed
        ]);

        // Mock the view instance
        $viewMock = $this->getMockBuilder(View::class)->getMock();

        // Mock the View facade to override the behavior of the view method
        ViewFacade::shouldReceive('make')
            ->with('suporte-tarefa.listar', ['ListaSuporteTarefa' => $mockedResponse])
            ->andReturn($viewMock);

        // Create an instance of the SuporteTarefaController
        $controller = new SuporteTarefaController();

        // Call the listar method
        $response = $controller->listar();

        // Assert that the response is the mocked SuporteTarefa model instance
        $this->assertSame($mockedResponse, $response);

        // Assert that the View facade was called with the correct parameters
        ViewFacade::shouldHaveReceived('make')
            ->with('suporte-tarefa.listar', ['ListaSuporteTarefa' => $mockedResponse])
            ->once();
    }
}
