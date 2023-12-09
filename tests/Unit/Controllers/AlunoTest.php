<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Support\Facades\Route;
use Mockery;

class AlunoControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        // "Mocar" (mock) dados de aluno
        $alunoMock = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        // "Mocar" (mock) o método get() do modelo Aluno
        $alunoMockery = Mockery::mock(Aluno::class);
        $alunoMockery->shouldReceive('get')->andReturn([$alunoMock]);

        // Substituir a implementação do modelo Aluno pelo mock
        $this->app->instance(Aluno::class, $alunoMockery);

        // Executar a rota de listar
        $response = $this->get(route('aluno.listar'));

        // Verificar se a resposta é bem-sucedida e contém a view esperada
        $response->assertStatus(200);
        $response->assertViewIs('aluno.listar');
    }

   
   
   
    public function testCriar()
    {
        // Executar a rota de criar
        $response = $this->get(route('aluno.criar'));

        // Verificar se a resposta é bem-sucedida e contém a view esperada
        $response->assertStatus(200);
        $response->assertViewIs('aluno.criar');
    }

    public function testSalvar()
    {
        // "Mocar" (mock) dados simulados para enviar no request
        $turmaMock = new Turma(['id' => 1, 'ativo' => true]);

        $this->app->instance(Turma::class, $turmaMock);

        $dados = [
            'nome' => 'John',
            'sobrenome' => 'Doe',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => $turmaMock->id,
        ];

        // Executar a rota de salvar
        $response = $this->post(route('aluno.salvar'), $dados);

        // Verificar se o redirecionamento ocorreu conforme esperado
        $response->assertRedirect(route('aluno.listar'));
    }

    public function testEditar()
    {
        // "Mocar" (mock) dados de aluno
        $alunoMock = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        // "Mocar" (mock) o método find() do modelo Aluno
        $alunoMockery = Mockery::mock(Aluno::class);
        $alunoMockery->shouldReceive('with')->andReturnSelf();
        $alunoMockery->shouldReceive('find')->andReturn($alunoMock);

        // Substituir a implementação do modelo Aluno pelo mock
        $this->app->instance(Aluno::class, $alunoMockery);

        // Executar a rota de editar
        $response = $this->get(route('aluno.editar', ['id' => 1]));

        // Verificar se a resposta é bem-sucedida e contém a view esperada
        $response->assertStatus(200);
        $response->assertViewIs('aluno.editar');
    }

    public function testAtualizar()
    {
        // "Mocar" (mock) dados simulados para enviar no request
        $turmaMock = new Turma(['id' => 1, 'ativo' => true]);

        $this->app->instance(Turma::class, $turmaMock);

        $dados = [
            'nome' => 'John',
            'sobrenome' => 'Doe',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => $turmaMock->id,
        ];

        // "Mocar" (mock) o método find() do modelo Aluno
        $alunoMockery = Mockery::mock(Aluno::class);
        $alunoMockery->shouldReceive('find')->andReturnSelf();
        $alunoMockery->shouldReceive('save')->andReturn(true);

        // Substituir a implementação do modelo Aluno pelo mock
        $this->app->instance(Aluno::class, $alunoMockery);

        // Executar a rota de atualizar
        $response = $this->put(route('aluno.atualizar', ['id' => 1]), $dados);

        // Verificar se o redirecionamento ocorreu conforme esperado
        $response->assertRedirect(route('aluno.listar'));
    }

    public function testExcluir()
    {
        // "Mocar" (mock) dados simulados para enviar no request
        $alunoMockery = Mockery::mock(Aluno::class);
        $alunoMockery->shouldReceive('delete')->andReturn(true);

        // Substituir a implementação do modelo Aluno pelo mock
        $this->app->instance(Aluno::class, $alunoMockery);

        // Executar a rota de excluir
        $response = $this->delete(route('aluno.excluir', ['id' => 1]));

        // Verificar se o redirecionamento ocorreu conforme esperado
        $response->assertRedirect(route('aluno.listar'));
    }


}
