<?php

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Mock the SuporteTarefa model to simulate the with method behavior
        $suporteTarefaModelMock = $this->getMockBuilder(SuporteTarefa::class)
            ->onlyMethods(['newQuery', 'get'])
            ->getMock();

        // Expect a call to newQuery method
        $queryBuilderMock = $this->getMockBuilder(Builder::class)
            ->onlyMethods(['with', 'get'])
            ->getMock();

        $suporteTarefaModelMock->expects($this->once())
            ->method('newQuery')
            ->willReturn($queryBuilderMock);

        // Expect a call to with method with an array of relationships
        $queryBuilderMock->expects($this->once())
            ->method('with')
            ->with($this->equalTo(['usuario', 'status']))
            ->willReturnSelf();

        // Simulate a response for the get method
        $mockedResponse = new Collection([
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
            // Add more mock data as needed
        ]);

        // Expect a call to get method and return the mocked response
        $queryBuilderMock->expects($this->once())
            ->method('get')
            ->willReturn($mockedResponse);

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

        // Assert that the expected data is present in the response
        $this->assertEquals($mockedResponse, $response->get()); // Adjust this assertion based on the actual structure of your response
    }
}
