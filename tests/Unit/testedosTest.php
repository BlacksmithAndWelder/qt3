<?php
use Tests\TestCase;
use App\Http\Controllers\Web\UsuarioController;
use App\Http\Requests\Usuario\Request as UsuarioRequest;
use Mockery;

class UsuarioControllerTest extends TestCase
{
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testSalvar()
    {
        // Criar uma instância simulada da classe de request usando Mockery
        $requestMock = Mockery::mock(UsuarioRequest::class);
        $requestMock->shouldReceive('validated')->andReturn([
            'nome' => 'Usuário Teste',
            'senha' => 'senha123',
            'email' => 'usuario@teste.com',
        ]);

        // Substituir a instância real pelo mock no contêiner de serviços
        $this->app->instance(UsuarioRequest::class, $requestMock);

        // Instanciar o controlador
        $usuarioController = new UsuarioController();

        // Chamar a função salvar do controlador
        $response = $usuarioController->salvar($requestMock);

        // Asserções
        $this->assertNotNull($response); // Adicione as asserções necessárias
    }
}
