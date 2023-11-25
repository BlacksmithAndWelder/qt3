<?php
use PHPUnit\Framework\TestCase;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    protected $suporteTarefaMock;

    public function setUp(): void
    {
        $this->suporteTarefaMock = Mockery::mock('overload:App\Models\SuporteTarefa');
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function setSuporteTarefa($suporteTarefaMock)
    {
        $this->suporteTarefaMock = $suporteTarefaMock;
    }

    public function testListar()
    {
        // Criar um mock para a classe de view
        $viewMock = Mockery::mock('Illuminate\View\View');
        
        // Configurar comportamentos esperados para o mock de SuporteTarefa
        $this->suporteTarefaMock->shouldReceive('with')->with(['usuario','status'])->andReturnSelf();
        $this->suporteTarefaMock->shouldReceive('get')->andReturn([]);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Substituir a instância do modelo SuporteTarefa pela mock
        $controller->setSuporteTarefa($this->suporteTarefaMock);

        // Substituir a função de view por um mock
        $controller->setView($viewMock);

        // Chamar a função a ser testada
        $result = $controller->listar();

        // Asserção para verificar se o resultado é uma instância de view
        $this->assertInstanceOf(\Illuminate\View\View::class, $result);
    }
}
