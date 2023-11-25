<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Http\Requests\SuporteTarefa\Request as SuporteTarefaRequest;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;
use Illuminate\Contracts\View\Factory as ViewFactory; // Importar a interface ViewFactory
use Illuminate\View\View; // Importar a classe View

class SuporteTarefaControllerTest extends TestCase
{
    // ... Teste anterior

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

        // Mock para o contêiner de serviço
        $containerMock = $this->getMockBuilder(\Illuminate\Container\Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock para a classe ViewFactory
        $viewFactoryMock = $this->createMock(ViewFactory::class);

        // Configuração do mock para o método 'make'
        $containerMock->expects($this->once())
            ->method('make')
            ->with(ViewFactory::class) // Espera uma chamada com a classe ViewFactory
            ->willReturn($viewFactoryMock); // Retorna o mock de ViewFactory

        // Mock para o controlador, passando o contêiner de serviço modificado
        $controller = $this->getMockBuilder(SuporteTarefaController::class)
            ->setConstructorArgs([$containerMock]) // Injeta o contêiner de serviço modificado
            ->setMethods(['criar'])
            ->getMock();

        // Configuração do mock para o método 'criar'
        $controller->expects($this->once())
            ->method('criar')
            ->willReturnCallback(function () use ($suporteTarefaMock, $listaUsuariosMock, $listaSuporteTarefaStatusMock, $viewFactoryMock) {
                // Use o mock de ViewFactory para criar uma instância da View
                $view = $this->createMock(View::class);

                $viewFactoryMock->expects($this->once())
                    ->method('make')
                    ->with('suporte-tarefa.criar', [
                        'SuporteTarefa' => $suporteTarefaMock,
                        'ListaUsuarios' => $listaUsuariosMock,
                        'ListaSuporteTarefaStatus' => $listaSuporteTarefaStatusMock,
                    ])
                    ->willReturn($view);

                return $view;
            });

        // Executa o teste
        $response = $controller->criar();

        $this->assertInstanceOf(View::class, $response);
    }

    // ... Métodos de teste adicionais
}
