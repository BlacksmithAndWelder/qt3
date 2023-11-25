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

        // Cria uma instância real da classe SuporteTarefaController
        $controller = new SuporteTarefaController();

        // Cria um mock para a ViewFactory
        $viewFactoryMock = $this->createMock(ViewFactory::class);

        // Modifica manualmente o contêiner de serviço da classe
        $container = $controller->getContainer();
        $container->instance(ViewFactory::class, $viewFactoryMock);

        // Configuração do mock para o método 'make'
        $viewFactoryMock->expects($this->once())
            ->method('make')
            ->with('suporte-tarefa.criar', [
                'SuporteTarefa' => $suporteTarefaMock,
                'ListaUsuarios' => $listaUsuariosMock,
                'ListaSuporteTarefaStatus' => $listaSuporteTarefaStatusMock,
            ])
            ->willReturn($this->createMock(View::class));

        // Executa o teste
        $response = $controller->criar();

        $this->assertInstanceOf(View::class, $response);
    }

    // ... Métodos de teste adicionais
}
