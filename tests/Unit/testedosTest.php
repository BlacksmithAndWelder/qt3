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

    public function testSalvar()
    {
        $mockRequest = m::mock(TurmaRequest::class);
        $mockTurma = m::mock(Turma::class);
        $mockEscola = m::mock(Escola::class);
        
        $mockRequest->shouldReceive('validated')->andReturn(['escola_id' => 1, 'ativo' => true, 'equipe' => 'equipe1', 'sala' => 'sala1']);
        $mockEscola->shouldReceive('find')->with(1)->andReturn(m::self());
        $mockTurma->shouldReceive('create')->with([
            'escola_id' => 1,
            'ativo' => true,
            'equipe' => 'equipe1',
            'sala' => 'sala1',
        ])->andReturn($mockTurma);

        $controller = new TurmaController($mockTurma, $mockEscola);
        $response = $controller->salvar($mockRequest);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
    }

    // Adicione outros testes para os métodos 'editar', 'atualizar', 'excluir' conforme necessário
}
