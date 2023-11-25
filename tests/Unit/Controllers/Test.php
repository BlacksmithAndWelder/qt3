<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Http\Requests\SuporteTarefa\Request as SuporteTarefaRequest;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

class SuporteTarefaControllerTest extends TestCase
{
    /**
     * Verifica se o método listar retorna a view correta.
     *
     * @return void
     */
    public function test_listar_method_returns_correct_view()
    {
        $controller = new SuporteTarefaController;
        $response = $controller->listar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('suporte-tarefa.listar', $response->getName());
    }

    /**
     * Testa o método criar.
     *
     * @return void
     */
    public function test_criar_method()
    {
        $controller = new SuporteTarefaController;
        $response = $controller->criar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('suporte-tarefa.criar', $response->getName());
    }

    /**
     * Testa o método salvar com dados válidos.
     *
     * @return void
     */
    public function test_salvar_method_with_valid_data()
    {
        // Mock da classe SuporteTarefaRequest para simular dados válidos
        $requestMock = $this->createMock(SuporteTarefaRequest::class);
        $requestMock->method('validated')->willReturn([
            'user_id' => 1,
            'status_id' => 1,
            'urgente' => true,
            'assunto' => 'Teste',
            'descricao' => 'Descrição do teste',
        ]);

        // Mock dos modelos User, SuporteTarefaStatus e SuporteTarefa
        $userMock = $this->createMock(User::class);
        $statusMock = $this->createMock(SuporteTarefaStatus::class);
        $suporteTarefaMock = $this->createMock(SuporteTarefa::class);
        $userMock->method('find')->willReturn($userMock);
        $statusMock->method('find')->willReturn($statusMock);
        $suporteTarefaMock->method('create')->willReturn($suporteTarefaMock);

        // Criar instância do controlador injetando os mocks
        $controller = new SuporteTarefaController($userMock, $statusMock, $suporteTarefaMock);
        $response = $controller->salvar($requestMock);

        // Verificar se o método redireciona para a rota correta e com a mensagem correta
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals('suporte-tarefa.listar', $response->getTargetUrl());
        $this->assertArrayHasKey('classe', $response->getSession()->all());
        $this->assertArrayHasKey('mensagem', $response->getSession()->all());
        $this->assertEquals('success', $response->getSession()->get('classe'));
        $this->assertEquals('Cadastro realizado com sucesso!', $response->getSession()->get('mensagem'));
    }

    // Adicione mais testes conforme necessário para outros métodos do controlador.
}
