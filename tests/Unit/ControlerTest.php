<?php
use PHPUnit\Framework\TestCase;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        // Criar um mock para o modelo SuporteTarefa
        $suporteTarefaMock = Mockery::mock('overload:App\Models\SuporteTarefa');
        // Definir um comportamento esperado para o método with
        $suporteTarefaMock->shouldReceive('with')->andReturnSelf();
        // Definir um comportamento esperado para o método get
        $suporteTarefaMock->shouldReceive('get')->andReturn([]);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Chamar a função a ser testada
        $result = $controller->listar();

        // Asserção para verificar se o resultado é uma instância de view, por exemplo
        $this->assertInstanceOf(\Illuminate\View\View::class, $result);
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

        // Substituir as instâncias dos modelos pela mock
        $controller->setUsuario($usuarioMock);
        $controller->setStatus($statusMock);

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
        $suporteTarefaMock->shouldReceive('create')->andReturn($suporteTarefaMock);

        // Criar uma instância do controlador
        $controller = new App\Http\Controllers\Web\Suporte\SuporteTarefaController();

        // Substituir a instância do modelo SuporteTarefa pela mock
        $controller->setSuporteTarefa($suporteTarefaMock);

        // Chamar a função a ser testada
        $result = $controller->salvar($requestMock);

        // Asserção para verificar se o redirecionamento ocorreu com sucesso
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $result);
    }
}
