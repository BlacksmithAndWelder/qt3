<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\Web\Escola\EscolaController;
use App\Http\Requests\Escola\Request as EscolaRequest;
use App\Models\Escola;
use Mockery;

class EscolaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        // "Mocar" (mock) dados de escola
        $escolaMock = new Escola([
            'nome' => 'Escola A',
            'segmento' => 'Ensino Fundamental',
            'endereco' => 'Rua Principal',
            'pais' => 'Brasil',
            'max_alunos' => 500,
        ]);

        // "Mocar" (mock) o método get() do modelo Escola
        $escolaMockery = Mockery::mock(Escola::class);
        $escolaMockery->shouldReceive('get')->andReturn([$escolaMock]);

        // Substituir a implementação do modelo Escola pelo mock
        $this->app->instance(Escola::class, $escolaMockery);

        // Executar a rota de listar
        $response = $this->get(route('escola.listar'));

        // Verificar se a resposta é bem-sucedida e contém a view esperada
        $response->assertStatus(200);
        $response->assertViewIs('escola.listar');
    }

    public function testCriar()
    {
        // Executar a rota de criar
        $response = $this->get(route('escola.criar'));

        // Verificar se a resposta é bem-sucedida e contém a view esperada
        $response->assertStatus(200);
        $response->assertViewIs('escola.criar');
    }

    public function testSalvar()
    {
        // "Mocar" (mock) dados simulados para enviar no request
        $dados = [
            'nome' => 'Nova Escola',
            'segmento' => 'Ensino Médio',
            'endereco' => 'Avenida Principal',
            'pais' => 'Brasil',
            'max_alunos' => 1000,
        ];

        // "Mocar" (mock) o método create() do modelo Escola
        $escolaMockery = Mockery::mock(Escola::class);
        $escolaMockery->shouldReceive('create')->once()->with($dados);

        // Substituir a implementação do modelo Escola pelo mock
        $this->app->instance(Escola::class, $escolaMockery);

        // Executar a rota de salvar
        $response = $this->post(route('escola.salvar'), $dados);

        // Verificar se o redirecionamento ocorreu conforme esperado
        $response->assertRedirect(route('escola.listar'));
    }

    public function testEditar()
    {
        // "Mocar" (mock) dados de escola
        $escolaMock = new Escola([
            'nome' => 'Escola B',
            'segmento' => 'Ensino Fundamental',
            'endereco' => 'Rua Secundária',
            'pais' => 'Brasil',
            'max_alunos' => 700,
        ]);

        // "Mocar" (mock) o método find() do modelo Escola
        $escolaMockery = Mockery::mock(Escola::class);
        $escolaMockery->shouldReceive('find')->with(1)->andReturn($escolaMock);

        // Substituir a implementação do modelo Escola pelo mock
        $this->app->instance(Escola::class, $escolaMockery);

        // Executar a rota de editar
        $response = $this->get(route('escola.editar', ['id' => 1]));

        // Verificar se a resposta é bem-sucedida e contém a view esperada
        $response->assertStatus(200);
        $response->assertViewIs('escola.editar');
    }

    public function testAtualizar()
    {
        // "Mocar" (mock) dados simulados para enviar no request
        $dados = [
            'nome' => 'Escola Atualizada',
            'segmento' => 'Ensino Médio',
            'endereco' => 'Avenida Atualizada',
            'pais' => 'Brasil',
            'max_alunos' => 1200,
        ];

        // "Mocar" (mock) o método find() do modelo Escola
        $escolaMockery = Mockery::mock(Escola::class);
        $escolaMockery->shouldReceive('find')->with(1)->andReturnSelf();
        $escolaMockery->shouldReceive('save')->once();

        // Substituir a implementação do modelo Escola pelo mock
        $this->app->instance(Escola::class, $escolaMockery);

        // Executar a rota de atualizar
        $response = $this->put(route('escola.atualizar', ['id' => 1]), $dados);

        // Verificar se o redirecionamento ocorreu conforme esperado
        $response->assertRedirect(route('escola.listar'));
    }

    public function testExcluir()
    {
        // "Mocar" (mock) o método find() do modelo Escola
        $escolaMockery = Mockery::mock(Escola::class);
        $escolaMockery->shouldReceive('find')->with(1)->andReturnSelf();
        $escolaMockery->shouldReceive('delete')->once();

        // Substituir a implementação do modelo Escola pelo mock
        $this->app->instance(Escola::class, $escolaMockery);

        // Executar a rota de excluir
        $response = $this->delete(route('escola.excluir', ['id' => 1]));

        // Verificar se o redirecionamento ocorreu conforme esperado
        $response->assertRedirect(route('escola.listar'));
    }
}
