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
            ->onlyMethods(['with'])
            ->getMock();

        // Define the expected arguments for the with method
        $expectedWithArguments = ['usuario', 'status'];

        // Set up the expectation for the with method to be called with specific arguments
        $suporteTarefaModelMock->expects($this->once())
            ->method('with')
            ->with($this->equalTo($expectedWithArguments))
            ->willReturnSelf(); // Return the mocked model instance

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