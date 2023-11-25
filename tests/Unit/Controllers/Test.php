<?php

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Http\Requests\SuporteTarefa\Request as SuporteTarefaRequest;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\View\View;

class SuporteTarefaControllerTest extends TestCase
{
    public function testCriarMethod()
    {
        // Mock para SuporteTarefa
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock para ListaUsuarios
        $listaUsuariosMock = $this->getMockBuilder(\Illuminate\Database\Eloquent\Collection::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock para ListaSuporteTarefaStatus
        $listaSuporteTarefaStatusMock = $this->getMockBuilder(\Illuminate\Database\Eloquent\Collection::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock para Eloquent Builder
        $eloquentBuilderMock = $this->getMockBuilder(\Illuminate\Database\Eloquent\Builder::class)
            ->disableOriginalConstructor()
            ->setMethods(['getModel', 'getConnection', 'newQuery'])  // Include 'getConnection' in the setMethods
            ->getMock();

        // Configuração do mock para o método 'make' da ViewFactory
        $viewFactoryMock = $this->createMock(ViewFactory::class);
        $viewFactoryMock->expects($this->once())
            ->method('make')
            ->with('suporte-tarefa.criar', [
                'SuporteTarefa' => $suporteTarefaMock,
                'ListaUsuarios' => $listaUsuariosMock,
                'ListaSuporteTarefaStatus' => $listaSuporteTarefaStatusMock,
            ])
            ->willReturn($this->createMock(View::class));

        // Configuração do mock para a conexão Eloquent
        $eloquentBuilderMock->expects($this->any())
            ->method('getModel')
            ->willReturn(new SuporteTarefa);

        $eloquentBuilderMock->expects($this->any())
            ->method('getConnection')
            ->willReturnSelf();

        $suporteTarefaMock->expects($this->any())
            ->method('newQuery')
            ->willReturn($eloquentBuilderMock);

        // Cria uma instância real da classe SuporteTarefaController
        $controller = new SuporteTarefaController();

        // Modifica manualmente o contêiner de serviço da classe
        $controller->viewFactory = $viewFactoryMock;

        // Executa o teste
        $response = $controller->criar();

        $this->assertInstanceOf(View::class, $response);
    }

    // ... Métodos de teste adicionais
}
