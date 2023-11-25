<?php
namespace Tests\Unit;
use Tests\TestCase;
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @codeCoverageIgnore
     */
    public function testListar()
    {
        // Crie um mock para o model Aluno
        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('get')->andReturn(collect([]));

        // Substitua a instância real do model pelo mock
        app()->instance(Aluno::class, $alunoMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('aluno');
        $response->assertViewIs('aluno.listar');
        $response->assertStatus(200);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testCriar()
    {
        // Crie mocks para os models Aluno e Turma
        $alunoMock = Mockery::mock(Aluno::class);
        $turmaMock = Mockery::mock(Turma::class);
        $turmaMock->shouldReceive('where')->andReturn($turmaMock);
        $turmaMock->shouldReceive('get')->andReturn(collect([]));

        // Substitua as instâncias reais dos models pelos mocks
        app()->instance(Aluno::class, $alunoMock);
        app()->instance(Turma::class, $turmaMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('aluno/criar');
        $response->assertViewIs('aluno.criar');
        $response->assertStatus(200);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testSalvar()
    {
        // Crie um mock para o request AlunoRequest
        $requestMock = Mockery::mock(AlunoRequest::class);
        $requestMock->shouldReceive('validated')->andReturn([]);

        // Crie um mock para o model Aluno
        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('create')->andReturn(new Aluno);

        // Substitua as instâncias reais pelo mock
        app()->instance(Aluno::class, $alunoMock);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->post('aluno', $requestMock->toArray());
        $response->assertRedirect(route('aluno.listar'));
    }

    /**
     * @codeCoverageIgnore
     */
    public function testEditar()
    {
        // Crie um mock para o model Aluno
        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('with->find')->andReturn(new Aluno);

        // Substitua a instância real pelo mock
        app()->instance(Aluno::class, $alunoMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('aluno/editar/1');
        $response->assertViewIs('aluno.editar');
        $response->assertStatus(200);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testAtualizar()
    {
        // Crie um mock para o request AlunoRequest
        $requestMock = Mockery::mock(AlunoRequest::class);
        $requestMock->shouldReceive('validated')->andReturn([]);

        // Crie um mock para o model Aluno
        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('find->update');

        // Substitua as instâncias reais pelos mocks
        app()->instance(Aluno::class, $alunoMock);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->post('aluno/atualizar/1', $requestMock->toArray());
        $response->assertRedirect(route('aluno.listar'));
    }

    /**
     * @codeCoverageIgnore
     */
    public function testExcluir()
    {
        // Crie um mock para o model Aluno
        $alunoMock = Mockery::mock(Aluno::class);
        $alunoMock->shouldReceive('find->delete');

        // Substitua a instância real pelo mock
