
<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\User;
use App\Models\SuporteTarefaStatus;
use Illuminate\View\View;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    /**
     * @codeCoverageIgnore
     */
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @codeCoverageIgnore
     */
    public function testListar()
    {
        // Criar um mock para o modelo SuporteTarefa
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);

        // Configurar o mock para o método with('usuario', 'status')->get()
        $suporteTarefaMock->shouldReceive('with')->withArgs(['usuario', 'status'])->andReturnSelf();
        $suporteTarefaMock->shouldReceive('get')->andReturn(collect()); // Você pode ajustar conforme necessário

        // Substituir a instância real por nosso mock na aplicação
        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);

        // Criar um mock para a classe View
        $viewMock = Mockery::mock(View::class);

        // Configurar o mock para o método view com os dados esperados
        $viewMock->shouldReceive('with')->withArgs(['ListaSuporteTarefa'])->andReturnSelf();

        // Substituir a função view por nosso mock
        $this->mock('view', $viewMock);

        // Instanciar o controlador
        $controller = new SuporteTarefaController();

        // Chamar o método listar
        $response = $controller->listar();

        // Verificar se o resultado é uma instância de View
        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * @codeCoverageIgnore
     */
    protected function mock($class, $mock)
    {
        app()->instance($class, $mock);

        return $mock;
    }
}
