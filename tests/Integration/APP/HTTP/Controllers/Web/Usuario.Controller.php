<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User as Usuario;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_usuarios()
    {
        // Add some test data to the database
        Usuario::factory()->count(3)->create();

        // Make a request to the listar endpoint
        $response = $this->get(route('usuario.listar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('usuario.listar');
    }

    /** @test */
    public function it_can_show_the_create_usuario_form()
    {
        // Make a request to the criar endpoint
        $response = $this->get(route('usuario.criar'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('usuario.criar');
    }

    /** @test */
    public function it_can_create_a_new_usuario()
    {
        // Mock data for creating a new usuario
        $data = [
            'nome' => 'Test Nome',
            'senha' => 'testpassword',
            'email' => 'test@example.com',
        ];

        // Make a request to the salvar endpoint with the mock data
        $response = $this->post(route('usuario.salvar'), $data);

        // Assert a successful response and that the usuario is created
        $response->assertRedirect(route('usuario.listar'));
        $this->assertDatabaseHas('users', ['name' => 'Test Nome', 'email' => 'test@example.com']);
    }

    /** @test */
    public function it_can_show_the_edit_usuario_form()
    {
        // Add a usuario test data to the database
        $usuario = Usuario::factory()->create();

        // Make a request to the editar endpoint
        $response = $this->get(route('usuario.editar', $usuario->id));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('usuario.editar');
    }

    /** @test */
    public function it_can_update_an_existing_usuario()
    {
        // Add a usuario test data to the database
        $usuario = Usuario::factory()->create();

        // Mock data for updating the usuario
        $data = [
            'nome' => 'Updated Nome',
            'senha' => 'updatedpassword',
            'email' => 'updated@example.com',
        ];

        // Make a request to the atualizar endpoint with the mock data
        $response = $this->put(route('usuario.atualizar', $usuario->id), $data);

        // Assert a successful response and that the usuario is updated
        $response->assertRedirect(route('usuario.listar'));
        $this->assertDatabaseHas('users', ['name' => 'Updated Nome', 'email' => 'updated@example.com']);
    }

    /** @test */
    public function it_can_delete_an_existing_usuario()
    {
        // Add a usuario test data to the database
        $usuario = Usuario::factory()->create();

        // Make a request to the excluir endpoint
        $response = $this->delete(route('usuario.excluir', $usuario->id));

        // Assert a successful response and that the usuario is deleted
        $response->assertRedirect(route('usuario.listar'));
        $this->assertDatabaseMissing('users', ['id' => $usuario->id]);
    }
}
