<?php
use Illuminate\View\View;
use Mockery;
use PHPUnit\Framework\TestCase;

class SuporteTarefaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        // Criar um mock para a classe de view
        $viewMock = Mockery::mock(View::class);

        // Configurar comportamentos esperados para o mock de SuporteTarefa
        $suporteTarefaMock = Mockery::mock('overload:App\Models\SuporteTarefa');
        $suporteTarefaMock->shouldReceive('with')->with(['usuario', 'status'])->andReturnSelf();
        $suporteTarefaMock->shouldReceive('get')->andReturn([]);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Substituir a função de criação de views por um mock
        app()->instance(View::class, $viewMock);

        // Chamar a função a ser testada
        $result = $controller->listar();

        // Asserção para verificar se o resultado é uma instância de view
        $this->assertInstanceOf(View::class, $result);
    }
}

