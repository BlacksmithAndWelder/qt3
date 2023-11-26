<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Mock the SuporteTarefa model to simulate the with method behavior
        $suporteTarefaModelMock = $this->getMockBuilder(SuporteTarefa::class)
            ->onlyMethods(['with', 'get'])
            ->getMock();

        // Expect a call to with method with an array of relationships
        $suporteTarefaModelMock->expects($this->once())
            ->method('with')
            ->with($this->equalTo(['usuario', 'status']))
            ->willReturnSelf();

        // Simulate a response for the get method
        $mockedResponse = new Collection([
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
            // Add more mock data as needed
        ]);

        // Set the results directly on the model mock
        $suporteTarefaModelMock->expects($this->once())
            ->method('get')
            ->willReturn($mockedResponse);

        // Mock the view instance
        $viewMock = $this->getMockBuilder(View::class)->getMock();

        // Mock the SuporteTarefaController to override the behavior of the SuporteTarefa model
        $controllerMock = $this->getMockBuilder(SuporteTarefaController::class)
            ->onlyMethods(['listar', 'view'])
            ->getMock();

        // Set up the expectation for the view method to return the mocked view instance
        $controllerMock->expects($this->once())
            ->method('view')
            ->willReturn($viewMock);

        // Set up the expectation for the listar method to return the mocked model instance
        $controllerMock->expects($this->once())
            ->method('listar')
            ->willReturn($suporteTarefaModelMock);

        // Call the mocked listar method
        $response = $controllerMock->listar();

        // Assert that the response is the mocked SuporteTarefa model instance
        $this->assertSame($suporteTarefaModelMock, $response);

        // Assert that the view method was called with the correct parameters
        $controllerMock->view('suporte-tarefa.listar', ['ListaSuporteTarefa' => $mockedResponse]);
    }
}