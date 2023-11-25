<?php
use PHPUnit\Framework\TestCase;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        // Criar um mock para o modelo SuporteTarefa
        $suporteTarefaMock = Mockery::mock('overload:App\Models\SuporteTarefa');
        // Definir um comportamento esperado para o método with
        $suporteTarefaMock->shouldReceive('with')->andReturnSelf();
        // Definir um comportamento esperado para o método get
        $suporteTarefaMock->shouldReceive('get')->andReturn([]);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Chamar a função a ser testada
        $result = $controller->listar();

        // Asserção para verificar se o resultado é uma instância de view, por exemplo
        $this->assertInstanceOf(\Illuminate\View\View::class, $result);
    }

    // Testar outras funções da mesma maneira...
}


