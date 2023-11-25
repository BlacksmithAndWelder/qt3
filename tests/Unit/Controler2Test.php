<?php

namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testCriar()
    {
        // Criar mocks para os modelos necessários
        $usuarioMock = Mockery::mock('overload:App\Models\User');
        $statusMock = Mockery::mock('overload:App\Models\SuporteTarefaStatus');

        // Configurar comportamentos esperados para os mocks
        $usuarioMock->shouldReceive('get')->andReturn([]);
        $statusMock->shouldReceive('get')->andReturn([]);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Chamar a função a ser testada
        $result = $controller->criar();

        // Asserção para verificar se o resultado é uma instância de view, por exemplo
        $this->assertInstanceOf(\Illuminate\View\View::class, $result);
    }

    public function testSalvar()
    {
        // Criar mocks para o modelo SuporteTarefa e o request
        $suporteTarefaMock = Mockery::mock('App\Models\SuporteTarefa');
        $requestMock = Mockery::mock('App\Http\Requests\SuporteTarefa\Request');

        // Configurar comportamentos esperados para os mocks
        $requestMock->shouldReceive('validated')->andReturn(['user_id' => 1, 'status_id' => 1, 'urgente' => true, 'assunto' => 'Teste', 'descricao' => 'Descrição']);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Substituir a instância do modelo SuporteTarefa pela mock
        $controller->setSuporteTarefa($suporteTarefaMock);

        // Chamar a função a ser testada
        $result = $controller->salvar($requestMock);

        // Asserção para verificar se o redirecionamento ocorreu com sucesso
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $result);
    }

    // Adicione testes para as outras funções conforme necessário
}

