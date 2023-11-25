<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarMethodReturnsCorrectView()
    {
        $controller = new SuporteTarefaController;
        $response = $controller->listar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
    }

    public function testCriarMethod()
    {
        $controller = new SuporteTarefaController;
        $response = $controller->criar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
    }

    public function testSalvarMethodWithValidData()
    {
        // Simula dados válidos
        $request = (object) [
            'validated' => [
                'user_id' => 1,
                'status_id' => 1,
                'urgente' => true,
                'assunto' => 'Teste',
                'descricao' => 'Descrição do teste',
            ],
        ];

        // Cria instância do controlador
        $controller = new SuporteTarefaController;

        // Executa o método salvar com os dados simulados
        $response = $controller->salvar($request);

        // Verifica se o método redireciona para a rota correta
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals('suporte-tarefa.listar', $response->getTargetUrl());
    }
}
