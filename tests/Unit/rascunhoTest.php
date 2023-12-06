<?php

namespace Tests\Unit\Routing;

use Tests\TestCase;
use App\Http\Controllers\Web\Usuario\UsuarioController;

class UsuarioRouteTest extends TestCase
{
    public function testListarRoute()
    {
        $response = $this->get('usuario');

        $response->assertStatus(200);
        $response->assertViewIs('usuario.listar');
    }

    public function testCriarRoute()
    {
        $response = $this->get('usuario/criar');

        $response->assertStatus(200);
        $response->assertViewIs('usuario.criar');
    }

    public function testSalvarRoute()
    {
        $response = $this->post('usuario', ['data' => 'your_data_here']);

        $response->assertStatus(302); // Assuming a redirect after saving
        $response->assertRedirect(route('usuario.listar'));
    }

    public function testEditarRoute()
    {
        $userId = 1; // Replace with an existing user ID
        $response = $this->get("usuario/editar/{$userId}");

        $response->assertStatus(200);
        $response->assertViewIs('usuario.editar');
    }

    public function testAtualizarRoute()
    {
        $userId = 1; // Replace with an existing user ID
        $response = $this->post("usuario/atualizar/{$userId}", ['data' => 'your_updated_data_here']);

        $response->assertStatus(302); // Assuming a redirect after updating
        $response->assertRedirect(route('usuario.listar'));
    }

    public function testExcluirRoute()
    {
        $userId = 1; // Replace with an existing user ID
        $response = $this->put("usuario/excluir/{$userId}");

        $response->assertStatus(302); // Assuming a redirect after deleting
        $response->assertRedirect(route('usuario.listar'));
    }
}
