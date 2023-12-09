<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaStatusController;
use App\Http\Requests\SuporteTarefaStatus\Request as SuporteTarefaStatusRequest;
use App\Models\SuporteTarefaStatus;
use Mockery;

class SuporteTarefaStatusControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testCriar()
    {
        // "Mocar" (mock) a instância do SuporteTarefaStatus
        $suporteTarefaStatusMockery = Mockery::mock(SuporteTarefaStatus::class);

        // Substituir a implementação do modelo SuporteTarefaStatus pelo mock
        $controller = new SuporteTarefaStatusController();
        $controller->setSuporteTarefaStatusModel($suporteTarefaStatusMockery);

        // Executar a função criar do controlador
        $response = $controller->criar();

        // Verificar se a view é a esperada
        $this->assertEquals('suporte-tarefa-status.criar', $response->getView());

        // Verificar se a variável SuporteTarefaStatus está definida na view
        $this->assertArrayHasKey('SuporteTarefaStatus', $response->getData());
    }

    public function testSalvar()
    {
        // "Mocar" (mock) os dados do formulário
        $requestData = ['nome' => 'Novo Status'];

        // "Mocar" (mock) o objeto da requisição
        $requestMockery = Mockery::mock(SuporteTarefaStatusRequest::class);
        $requestMockery->shouldReceive('validated')->andReturn($requestData);

        // "Mocar" (mock) a instância do SuporteTarefaStatus
        $suporteTarefaStatusMockery = Mockery::mock(SuporteTarefaStatus::class);
        $suporteTarefaStatusMockery->shouldReceive('create')->with($requestData);

        // Substituir a implementação do modelo SuporteTarefaStatus e a instância da requisição pelos mocks
        $controller = new SuporteTarefaStatusController();
        $controller->setSuporteTarefaStatusModel($suporteTarefaStatusMockery);
        $controller->setSuporteTarefaStatusRequest($requestMockery);

        // Executar a função salvar do controlador
        $response = $controller->salvar();

        // Verificar se o redirecionamento é o esperado
        $this->assertEquals('suporte-tarefa-status.listar', $response->getTargetUrl());
    }

    public function testEditar()
    {
        // "Mocar" (mock) os dados do SuporteTarefaStatus
        $suporteTarefaStatusMock = new SuporteTarefaStatus(['nome' => 'Teste']);

        // "Mocar" (mock) o método find() do modelo SuporteTarefaStatus
        $suporteTarefaStatusMockery = Mockery::mock(SuporteTarefaStatus::class);
        $suporteTarefaStatusMockery->shouldReceive('find')->with(1)->andReturn($suporteTarefaStatusMock);

        // Substituir a implementação do modelo SuporteTarefaStatus pelo mock
        $controller = new SuporteTarefaStatusController();
        $controller->setSuporteTarefaStatusModel($suporteTarefaStatusMockery);

        // Executar a função editar do controlador
        $response = $controller->editar(1);

        // Verificar se a view é a esperada
        $this->assertEquals('suporte-tarefa-status.editar', $response->getView());

        // Verificar se a variável SuporteTarefaStatus está definida na view
        $this->assertArrayHasKey('SuporteTarefaStatus', $response->getData());
    }

    public function testAtualizar()
    {
        // "Mocar" (mock) os dados do formulário
        $requestData = ['nome' => 'Status Atualizado'];

        // "Mocar" (mock) o objeto da requisição
        $requestMockery = Mockery::mock(SuporteTarefaStatusRequest::class);
        $requestMockery->shouldReceive('validated')->andReturn($requestData);

        // "Mocar" (mock) a instância do SuporteTarefaStatus
        $suporteTarefaStatusMockery = Mockery::mock(SuporteTarefaStatus::class);
        $suporteTarefaStatusMockery->shouldReceive('find')->with(1)->andReturn($suporteTarefaStatusMock);
        $suporteTarefaStatusMockery->shouldReceive('save');

        // Substituir a implementação do modelo SuporteTarefaStatus e a instância da requisição pelos mocks
        $controller = new SuporteTarefaStatusController();
        $controller->setSuporteTarefaStatusModel($suporteTarefaStatusMockery);
        $controller->setSuporteTarefaStatusRequest($requestMockery);

        // Executar a função atualizar do controlador
        $response = $controller->atualizar(1);

        // Verificar se o redirecionamento é o esperado
        $this->assertEquals('suporte-tarefa-status.listar', $response->getTargetUrl());
    }

    public function testExcluir()
    {
        // "Mocar" (mock) a instância do SuporteTarefaStatus
        $suporteTarefaStatusMockery = Mockery::mock(SuporteTarefaStatus::class);
        $suporteTarefaStatusMockery->shouldReceive('find')->with(1)->andReturn($suporteTarefaStatusMockery);
        $suporteTarefaStatusMockery->shouldReceive('delete');

        // Substituir a implementação do modelo SuporteTarefaStatus pelo mock
        $controller = new SuporteTarefaStatusController();
        $controller->setSuporteTarefaStatusModel($suporteTarefaStatusMockery);

        // Executar a função excluir do controlador
        $response = $controller->excluir(1);

        // Verificar se o redirecionamento é o esperado
        $this->assertEquals('suporte-tarefa-status.listar', $response->getTargetUrl());
    }
}
