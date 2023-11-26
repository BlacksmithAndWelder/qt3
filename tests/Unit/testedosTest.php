<?php
use Tests\TestCase;
use App\Http\Controllers\Web\Escola\EscolaController;
use App\Http\Requests\Escola\Request as EscolaRequest;
use App\Models\Escola;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscolaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListar()
    {
        // Inicialize o banco de dados com algumas escolas fictícias
        factory(Escola::class, 3)->create();

        $escolaController = new EscolaController();

        $view = $escolaController->listar();

        $this->assertIsObject($view);
        $this->assertEquals('escola.listar', $view->name());
        $this->assertViewHas('ListaEscola');
    }

    public function testCriar()
    {
        $escolaController = new EscolaController();

        $view = $escolaController->criar();

        $this->assertIsObject($view);
        $this->assertEquals('escola.criar', $view->name());
        $this->assertViewHas('Escola');
    }

    public function testSalvar()
    {
        $dados = [
            'nome' => 'Escola Teste',
            'segmento' => 'Ensino Médio',
            // Adicione outros campos conforme necessário
        ];

        $request = new EscolaRequest($dados);

        $escolaController = new EscolaController();

        $response = $escolaController->salvar($request);

        $this->assertRedirect(route('escola.listar'), $response);
        $this->assertSessionHas(['classe' => 'success', 'mensagem' => 'Cadastro realizado com sucesso!']);
    }

    // Adicione testes semelhantes para as funções editar, atualizar e excluir
}
