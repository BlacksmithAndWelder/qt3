<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarMethodReturnsCorrectView()
    {
        $controller = new SuporteTarefaController;
        $response = $controller->listar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('suporte-tarefa.listar', $response->getName());
    }

    public function testCriarMethod()
    {
        $controller = new SuporteTarefaController;
        $response = $controller->criar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('suporte-tarefa.criar', $response->getName());
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

        // Mock dos modelos User, SuporteTarefaStatus e SuporteTarefa
        $userMock = $this->createMock(User::class);
        $statusMock = $this->createMock(SuporteTarefaStatus::class);
        $suporteTarefaMock = $this->createMock(SuporteTarefa::class);

        // Configuração dos mocks
        $userMock->method('find')->willReturn($userMock);
        $statusMock->method('find')->willReturn($statusMock);
        $suporteTarefaMock->method('create')->willReturn($suporteTarefaMock);

        // Cria instância do controlador injetando os mocks
        $controller = new SuporteTarefaController($userMock, $statusMock, $suporteTarefaMock);
        $response = $controller->salvar($request);

        // Verificações
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals('suporte-tarefa.listar', $response->getTargetUrl());
        $this->assertArrayHasKey('classe', $response->getSession()->all());
        $this->assertArrayHasKey('mensagem', $response->getSession()->all());
        $this->assertEquals('success', $response->getSession()->get('classe'));
        $this->assertEquals('Cadastro realizado com sucesso!', $response->getSession()->get('mensagem'));
    }
}
