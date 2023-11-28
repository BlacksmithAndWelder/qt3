<?php
use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Turma\TurmaController;
use App\Models\Turma;

class TurmaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testListar()
    {
        // Cria um mock para a classe Turma
        $mockTurma = m::mock(Turma::class);
        $mockTurma->shouldReceive('with->get')->andReturn(['item1', 'item2', 'item3']);

        // Cria uma instância do controlador passando o mockTurma
        $controller = new TurmaController($mockTurma);

        // Chama diretamente o método a ser testado, evitando a resolução automática de dependências
        $view = $controller->listar($mockTurma);

        // Faz as asserções dos resultados
        $this->assertEquals('turma.listar', $view->name());
        $this->assertEquals(['item1', 'item2', 'item3'], $view->getData()['ListaTurma']);
    }
}
