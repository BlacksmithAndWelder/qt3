<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Mock the SuporteTarefa model to simulate the with method behavior
        $suporteTarefaModelMock = $this->getMockBuilder(SuporteTarefa::class)
            ->onlyMethods(['newQuery', 'get'])
            ->getMock();

        // Expect a call to newQuery method
        $suporteTarefaModelMock->expects($this->once())
            ->method('newQuery')
            ->willReturnSelf();

        // Expect a call to get method with an array of relationships
        $suporteTarefaModelMock->expects($this->once())
            ->method('get')
            ->with(['usuario', 'status'])
            ->willReturnSelf();

        // Mock the SuporteTarefaController to override the behavior of the SuporteTarefa model
        $controllerMock = $this->getMockBuilder(SuporteTarefaController::class)
            ->onlyMethods(['listar'])
            ->getMock();

        // Set up the expectation for the listar method to return the mocked model instance
        $controllerMock->expects($this->once())
            ->method('listar')
            ->willReturn($suporteTarefaModelMock);

        // Call the mocked listar method
        $response = $controllerMock->listar();

        // Assert that the response is the mocked SuporteTarefa model instance
        $this->assertSame($suporteTarefaModelMock, $response);
    }
}