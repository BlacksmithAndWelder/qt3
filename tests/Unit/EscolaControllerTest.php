<?php
use Tests\TestCase;
use App\Http\Controllers\Web\Escola\EscolaController;
use App\Http\Requests\Escola\Request as EscolaRequest;
use App\Models\Escola;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscolaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListar()
    {
        // Configurar o mock para a classe Escola
        $escolaMock = $this->getMockBuilder(Escola::class)->getMock();

        // Simular o retorno de dados da chamada de banco de dados
        $escolaMock->method('get')->willReturn(collect([]));

        // Substituir a instância real da classe Escola pela instância mock no contêiner de serviço do aplicativo
        $this->app->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola');
        $response->assertViewIs('escola.listar');
        $response->assertStatus(200);
    }

    public function testCriar()
    {
        // Configurar o mock para a classe Escola
        $escolaMock = $this->getMockBuilder(Escola::class)->getMock();

        // Simular o retorno de dados da chamada de banco de dados
        $escolaMock->method('create')->willReturn(new Escola);

        // Substituir a instância real da classe Escola pela instância mock no contêiner de serviço do aplicativo
        $this->app->instance(Escola::class, $escolaMock);

        // Chame a rota e verifique se a view é retornada
        $response = $this->get('escola/criar');
        $response->assertViewIs('escola.criar');
        $response->assertStatus(200);
    }

    // Outros métodos de teste...
}
