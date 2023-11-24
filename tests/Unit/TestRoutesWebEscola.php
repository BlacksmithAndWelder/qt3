<?php

namespace Tests\Unit\Controllers\Web\Escola;

use Tests\TestCase;
use App\Http\Controllers\Web\Escola\EscolaController;
use App\Http\Requests\Escola\Request as EscolaRequest;
use App\Models\Escola;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class EscolaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListar()
    {
        // Crie um mock para o model Escola
        $escolaMock = Mockery::mock(Escola::class);
        $escolaMock->shouldReceive('get')->andReturn(collect([]));

        // Substitua a instância real do model pelo mock
        app()->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola');
        $response->assertViewIs('escola.listar');
        $response->assertStatus(200);
    }

    public function testCriar()
    {
        // Crie um mock para o model Escola
        $escolaMock = Mockery::mock(Escola::class);

        // Substitua a instância real do model pelo mock
        app()->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola/criar');
        $response->assertViewIs('escola.criar');
        $response->assertStatus(200);
    }

    public function testSalvar()
    {
        // Crie um mock para o request EscolaRequest
        $requestMock = Mockery::mock(EscolaRequest::class);
        $requestMock->shouldReceive('validated')->andReturn([]);

        // Crie um mock para o model Escola
        $escolaMock = Mockery::mock(Escola::class);
        $escolaMock->shouldReceive('create')->andReturn(new Escola);

        // Substitua as instâncias reais pelos mocks
        app()->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->post('escola', $requestMock->toArray());
        $response->assertRedirect(route('escola.listar'));
    }

    public function testEditar()
    {
        // Crie um mock para o model Escola
        $escolaMock = Mockery::mock(Escola::class);
        $escolaMock->shouldReceive('find')->andReturn(new Escola);

        // Substitua a instância real do model pelo mock
        app()->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola/editar/1');
        $response->assertViewIs('escola.editar');
        $response->assertStatus(200);
    }

    public function testAtualizar()
    {
        // Crie um mock para o request EscolaRequest
        $requestMock = Mockery::mock(EscolaRequest::class);
        $requestMock->shouldReceive('validated')->andReturn([]);

        // Crie um mock para o model Escola
        $escolaMock = Mockery::mock(Escola::class);
        $escolaMock->shouldReceive('find->update');

        // Substitua as instâncias reais pelos mocks
        app()->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->post('escola/atualizar/1', $requestMock->toArray());
        $response->assertRedirect(route('escola.listar'));
    }

    public function testExcluir()
    {
        // Crie um mock para o model Escola
        $escolaMock = Mockery::mock(Escola::class);
        $escolaMock->shouldReceive('find->delete');

        // Substitua a instância real do model pelo mock
        app()->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->put('escola/excluir/1');
        $response->assertRedirect(route('escola.listar'));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
