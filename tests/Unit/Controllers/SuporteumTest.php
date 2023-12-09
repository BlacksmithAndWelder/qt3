<?php 
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Http\Requests\SuporteTarefa\Request as SuporteTarefaRequest;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;
use Mockery;

class SuporteTarefaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testListar()
    {
        // "Mocar" (mock) os dados de suporte-tarefa
        $suporteTarefaMock = new SuporteTarefa(['assunto' => 'Teste', 'descricao' => 'Descrição de teste']);
        
        // "Mocar" (mock) o método with() do modelo SuporteTarefa
        $suporteTarefaMockery = Mockery::mock(SuporteTarefa::class);
        $suporteTarefaMockery->shouldReceive('with')->andReturn($suporteTarefaMock);

        // Substituir a implementação do modelo SuporteTarefa pelo mock
        $controller = new SuporteTarefaController();
        $controller->setSuporteTarefaModel($suporteTarefaMockery);

        // Executar a função listar do controlador
        $response = $controller->listar();

        // Verificar se a view é a esperada
        $this->assertEquals('suporte-tarefa.listar', $response->getView());

        // Verificar se a variável ListaSuporteTarefa está definida na view
        $this->assertArrayHasKey('ListaSuporteTarefa', $response->getData());

        // Verificar se a variável ListaSuporteTarefa contém os dados esperados
        $this->assertEquals('Teste', $response->getData()['ListaSuporteTarefa'][0]->assunto);
        $this->assertEquals('Descrição de teste', $response->getData()['ListaSuporteTarefa'][0]->descricao);
    }

    // Adicione testes semelhantes para outros métodos do controlador (criar, salvar, editar, atualizar, excluir)
}
