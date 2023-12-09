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

    // Adicione testes semelhantes para outros métodos do controlador (criar, salvar, editar, atualizar, excluir)
}
