<?php

namespace Tests\Unit\Controllers\Web\Usuario;

use Mockery;
use Tests\TestCase;
use App\Http\Controllers\Web\Usuario\UsuarioController;
use App\Models\User as Usuario;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\Usuario\Request as UsuarioRequest;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_view_with_users()
    {
        // Criar um mock para o modelo Usuario
        $usuarioMock = Mockery::mock(Usuario::class);
        
        // Configurar o mock para retornar uma coleção de usuários fictícios
        $usuarioMock->shouldReceive('get')->andReturn(collect([
            new Usuario(['name' => 'User1', 'email' => 'user1@example.com']),
            new Usuario(['name' => 'User2', 'email' => 'user2@example.com']),
        ]));

        // Substituir o resolvedor de instância para Usuario com o mock
        $this->app->instance(Usuario::class, $usuarioMock);

        // Chamar o método listar no controlador
        $controller = new UsuarioController();
        $response = $controller->listar();

        // Verificar se a view é retornada com os dados corretos
        $response->assertViewIs('usuario.listar');
        $response->assertViewHas('ListaUsuarios', function ($usuarios) {
            return $usuarios->count() == 2;
        });
    }

    // Adicionar mais casos de teste conforme necessário
}
