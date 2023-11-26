<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Tests\TestCase;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Criar alguns dados de teste usando a instância do Eloquent Collection
        $mockedData = new Collection([
            new SuporteTarefa(['assunto' => 'Assunto 1', 'descricao' => 'Descrição 1']),
            new SuporteTarefa(['assunto' => 'Assunto 2', 'descricao' => 'Descrição 2']),
            // Adicionar mais dados conforme necessário
        ]);

        // Criar uma instância do controlador
        $controller = new SuporteTarefaController();

        // Chamar a função 'listar' com os dados mockados
        $response = $controller->listar($mockedData);

        // Verificar se a resposta é uma instância de View
        $this->assertInstanceOf(View::class, $response);

        // Verificar se a view correta está sendo retornada
        $this->assertEquals('suporte-tarefa.listar', $response->getName());

        // Verificar se os dados mockados estão sendo passados para a view
        $this->assertEquals($mockedData, $response->getData()['ListaSuporteTarefa']);
    }

        public function testCriarFunction()
    {
        // Criar uma instância do controlador
        $controller = new SuporteTarefaController();

        // Chamar a função 'criar'
        $response = $controller->criar();

        // Verificar se a resposta é uma instância de View
        $this->assertInstanceOf(View::class, $response);

        // Verificar se a view correta está sendo retornada
        $this->assertEquals('suporte-tarefa.criar', $response->getName());
    }


}
