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

    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations and seed your database
        $this->artisan('migrate');
    }

    public function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    /** @test */
    public function it_should_return_view_with_users()
    {
        // Mock the Usuario model to return a fake list of users
        $usuarioMock = Mockery::mock(Usuario::class);
        $usuarioMock->shouldReceive('get')->andReturn(collect([
            new Usuario(['name' => 'User1', 'email' => 'user1@example.com']),
            new Usuario(['name' => 'User2', 'email' => 'user2@example.com']),
        ]));

        // Replace the actual model with the mock in the container
        app()->instance(Usuario::class, $usuarioMock);

        // Call the listar method on the controller
        $controller = new UsuarioController();
        $response = $controller->listar();

        // Assert that the view is returned with the correct data
        $response->assertViewIs('usuario.listar');
        $response->assertViewHas('ListaUsuarios', function ($usuarios) {
            return $usuarios->count() == 2;
        });
    }

    // Add more test cases as needed
}
