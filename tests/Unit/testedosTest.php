<?php
use Mockery as m;
use App\Http\Controllers\Web\Turma\TurmaController;
use App\Http\Requests\Turma\Request as TurmaRequest;
use App\Models\Escola;
use App\Models\Turma;
use Tests\TestCase;

class TurmaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    
    public function testListar()
    {
        $mockTurma = m::mock(Turma::class);
        $mockTurma->shouldReceive('with->get')->andReturn(['item1', 'item2', 'item3']);

        $controller = new TurmaController($mockTurma);

        $view = $controller->listar();

        $this->assertEquals('turma.listar', $view->name());
        $this->assertEquals(['item1', 'item2', 'item3'], $view->getData()['ListaTurma']);
    }

    public function testCriar()
    {
        $mockTurma = m::mock(Turma::class);
        $mockEscola = m::mock(Escola::class);
        $mockEscola->shouldReceive('get')->andReturn(['escola1', 'escola2']);

        $controller = new TurmaController($mockTurma, $mockEscola);

        $view = $controller->criar();

        $this->assertEquals('turma.criar', $view->name());
        $this->assertInstanceOf(Turma::class, $view->getData()['Turma']);
        $this->assertEquals(['escola1', 'escola2'], $view->getData()['ListaEscolas']);
    }

    // Adicione outros testes para os métodos 'salvar', 'editar', 'atualizar', 'excluir' conforme necessário
}
