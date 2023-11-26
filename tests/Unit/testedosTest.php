<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Tests\TestCase;

class SuporteTControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testEditarFunction()
    {
        // Criar um ID de tarefa para editar
        $tarefaId = 1;

        // Criar uma tarefa mockada
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configurar o mock para retornar uma tarefa mockada ao chamar 'find'
        $suporteTarefaMock->method('find')->willReturn(new SuporteTarefa(['assunto' => 'Assunto Editado', 'descricao' => 'Descrição Editada']));

        // Substituir a implementação real pelo mock
        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);

        // Chamar a rota que corresponde à função 'editar'
        $response = $this->get(route('suporte-tarefa.editar', ['id' => $tarefaId]));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.editar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.editar');

        // Verificar se os dados da tarefa mockada estão presentes na view
        $response->assertViewHas('SuporteTarefa', ['assunto' => 'Assunto Editado', 'descricao' => 'Descrição Editada']);
    }

    public function testExcluirFunction()
    {
        // Criar um ID de tarefa para excluir
        $tarefaId = 1;

        // Criar uma tarefa mockada
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configurar o mock para retornar uma tarefa mockada ao chamar 'find'
        $suporteTarefaMock->method('find')->willReturn(new SuporteTarefa(['assunto' => 'Assunto Excluído', 'descricao' => 'Descrição Excluída']));

        // Substituir a implementação real pelo mock
        $this->app->instance(SuporteTarefa::class, $suporteTarefaMock);

        // Chamar a rota que corresponde à função 'excluir'
        $response = $this->delete(route('suporte-tarefa.excluir', ['id' => $tarefaId]));

        // Verificar se a resposta redireciona para a rota 'suporte-tarefa.listar'
        $response->assertRedirect(route('suporte-tarefa.listar'));

        // Verificar se a mensagem de exclusão bem-sucedida está presente na sessão
        $this->assertSessionHas('classe', 'success');
        $this->assertSessionHas('mensagem', 'Exclusão realizada com sucesso!');
    }
}
