<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     * @codeCoverageIgnore
     */
    public function testListar()
    {
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaMock->shouldReceive('with')->withArgs(['usuario', 'status'])->andReturnSelf();
        $suporteTarefaMock->shouldReceive('get')->andReturn(collect());

        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);

        $controller = new SuporteTarefaController();
        $response = $controller->listar();

        $response->assertViewIs('suporte-tarefa.listar');
    }

    /**
     * @codeCoverageIgnore
     */
    public function testCriar()
    {
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);
        $usuarioMock = Mockery::mock(Usuario::class);

        $suporteTarefaStatusMock->shouldReceive('get')->andReturn(collect());
        $usuarioMock->shouldReceive('get')->andReturn(collect());

        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);
        $this->app->instance(SuporteTarefaStatus::class, $suporteTarefaStatusMock);
        $this->app->instance(Usuario::class, $usuarioMock);

        $controller = new SuporteTarefaController();
        $response = $controller->criar();

        $response->assertViewIs('suporte-tarefa.criar');
    }

    /**
     * @codeCoverageIgnore
     */
    public function testSalvar()
    {
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);
        $usuarioMock = Mockery::mock(Usuario::class);
        $suporteTarefaStatusMock = Mockery::mock(SuporteTarefaStatus::class);

        $dadosMock = [
            'user_id' => 1,
            'status_id' => 1,
            'urgente' => true,
            'assunto' => 'Teste',
            'descricao' => 'Descrição de teste',
        ];

        $usuarioMock->shouldReceive('find')->with($dadosMock['user_id'])->andReturn(new Usuario());
        $suporteTarefaStatusMock->shouldReceive('find')->with($dadosMock['status_id'])->andReturn(new SuporteTarefaStatus());
        $suporteTarefaMock->shouldReceive('create')->with($dadosMock)->andReturn(new SuporteTarefa());

        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);
        $this->app->instance(Usuario::class, $usuarioMock);
        $this->app->instance(SuporteTarefaStatus::class, $suporteTarefaStatusMock);

        $controller = new SuporteTarefaController();
        $response = $controller->salvar($dadosMock);

        $response->assertRedirect(route('suporte-tarefa.listar'));
    }

    // ... outros testes ...
}
