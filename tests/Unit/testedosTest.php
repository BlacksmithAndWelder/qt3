<?php

namespace Tests\Unit\Controllers\Web\Usuario;

use Illuminate\Foundation\Testing\DatabaseMock;
use Tests\TestCase;
use App\Http\Controllers\Web\Usuario\UsuarioController;
use App\Models\User as Usuario;
use Illuminate\Support\Facades\DB;

class UsuarioControllerTest extends TestCase
{
    use DatabaseMock;

    /** @test */
    public function it_should_return_view_with_users()
    {
        // Mock the Usuario model to return a fake list of users
        DB::shouldReceive('table->get')->andReturn(collect([
            ['name' => 'User1', 'email' => 'user1@example.com'],
            ['name' => 'User2', 'email' => 'user2@example.com'],
        ]));

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
