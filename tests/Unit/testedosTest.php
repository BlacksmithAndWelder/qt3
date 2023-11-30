<?php
use Tests\TestCase;
use App\Http\Controllers\Web\Usuario\UsuarioController;
use App\Http\Requests\Usuario\Request as UsuarioRequest;
use App\Models\Usuario; // Importe o modelo real
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

        // Criar um mock para o modelo de usuário
        $usuarioMock = Mockery::mock(Usuario::class);
        $usuarioMock->shouldReceive('create')->once(); // Espera que o método create seja chamado uma vez

        // Substituir a instância real pelo mock no contêiner de serviços
        $this->app->instance(UsuarioRequest::class, $requestMock);
        $this->app->instance(Usuario::class, $usuarioMock);

        // Instanciar o controlador
        $usuarioController = new UsuarioController();

        // Chamar a função salvar do controlador
        $response = $usuarioController->salvar($requestMock);

        // Asserções
        $this->assertNotNull($response); // Adicione as asserções necessárias
    }
}
