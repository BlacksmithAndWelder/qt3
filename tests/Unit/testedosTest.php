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

    // Adicione outros testes para os métodos 'listar', 'salvar', 'editar', 'atualizar', 'excluir' conforme necessário
}
