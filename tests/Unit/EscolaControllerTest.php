<?php
use Tests\TestCase;
use App\Http\Controllers\Web\Escola\EscolaController;
use App\Http\Requests\Escola\Request as EscolaRequest;
use App\Models\Escola;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscolaControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @codeCoverageIgnore
     */
    public function testListar()
    {
        // Criar uma instância de Escola
        $escola = Escola::factory()->make();

        // Substituir a chamada real do método get() pelo método get() simulado
        Escola::shouldReceive('get')->andReturn(collect([$escola]));

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola');
        $response->assertViewIs('escola.listar');
        $response->assertStatus(200);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testCriar()
    {
        // Substituir a chamada real do método create() pelo método create() simulado
        Escola::shouldReceive('create')->andReturn(new Escola);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola/criar');
        $response->assertViewIs('escola.criar');
        $response->assertStatus(200);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testSalvar()
    {
        // Substituir a chamada real do método create() pelo método create() simulado
        Escola::shouldReceive('create')->andReturn(new Escola);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->post('escola', ['nome' => 'Escola Teste']);
        $response->assertRedirect(route('escola.listar'));
    }

    /**
     * @codeCoverageIgnore
     */
    public function testEditar()
    {
        // Criar uma instância de Escola
        $escola = Escola::factory()->make();

        // Substituir a chamada real do método find() pelo método find() simulado
        Escola::shouldReceive('find')->with(1)->andReturn($escola);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola/editar/1');
        $response->assertViewIs('escola.editar');
        $response->assertStatus(200);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testAtualizar()
    {
        // Criar uma instância de Escola
        $escola = Escola::factory()->make();

        // Substituir a chamada real do método find() pelo método find() simulado
        Escola::shouldReceive('find')->with(1)->andReturn($escola);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->post('escola/atualizar/1', ['nome' => 'Escola Atualizada']);
        $response->assertRedirect(route('escola.listar'));
    }

    /**
     * @codeCoverageIgnore
     */
    public function testExcluir()
    {
        // Criar uma instância de Escola
        $escola = Escola::factory()->make();

        // Substituir a chamada real do método find() pelo método find() simulado
        Escola::shouldReceive('find')->with(1)->andReturn($escola);

        // Substituir a chamada real do método delete() pelo método delete() simulado
        Escola::shouldReceive('delete')->andReturn(true);

        // Chame a rota e verifique se é redirecionado corretamente
        $response = $this->put('escola/excluir/1');
        $response->assertRedirect(route('escola.listar'));
    }
}

