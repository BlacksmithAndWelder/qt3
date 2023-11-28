<?php
use Mockery as m;
use Tests\TestCase;
use App\Http\Controllers\Web\Turma\TurmaController;
use App\Http\Requests\Turma\Request as TurmaRequest;
use App\Models\Escola;
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

        // Chama o método a ser testado
        $view = $controller->listar();

        // Faz as asserções dos resultados
        $this->assertEquals('turma.listar', $view->name());
        $this->assertEquals(['item1', 'item2', 'item3'], $view->getData()['ListaTurma']);
    }

    public function testCriar()
    {
        // Cria mocks para Turma e Escola
        $mockTurma = m::mock(Turma::class);
        $mockEscola = m::mock(Escola::class);
        $mockEscola->shouldReceive('get')->andReturn(['escola1', 'escola2']);

        // Cria uma instância do controlador passando os mocks
        $controller = new TurmaController($mockTurma, $mockEscola);

        // Chama o método a ser testado
        $view = $controller->criar();

        // Faz as asserções dos resultados
        $this->assertEquals('turma.criar', $view->name());
        $this->assertInstanceOf(Turma::class, $view->getData()['Turma']);
        $this->assertEquals(['escola1', 'escola2'], $view->getData()['ListaEscolas']);
    }

    // Adicione outros testes para os métodos 'salvar', 'editar', 'atualizar', 'excluir' conforme necessário
}
