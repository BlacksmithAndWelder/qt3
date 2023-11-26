<?php
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use App\Models\SuporteTarefa;
use App\Models\User;
use App\Models\SuporteTarefaStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Tests\TestCase;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Criar uma instância do controlador
        $controller = new SuporteTarefaController();

        // Mock da classe SuporteTarefa para simular o comportamento do Eloquent
        $suporteTarefaMock = $this->createMock(SuporteTarefa::class);

        // Simular um resultado para a função with do Eloquent
        $suporteTarefaMock->expects($this->once())
            ->method('with')
            ->willReturnSelf();

        // Simular um resultado para a função get do Eloquent
        $suporteTarefaMock->expects($this->once())
            ->method('get')
            ->willReturn(new Collection([])); // Pode adicionar dados mockados conforme necessário

        // Substituir a instância real por nosso mock
        $controller->setSuporteTarefa($suporteTarefaMock);

        // Chamar a função 'listar'
        $response = $controller->listar();

        // Verificar se a resposta é uma instância de View
        $this->assertInstanceOf(View::class, $response);

        // Verificar se a view correta está sendo retornada
        $this->assertEquals('suporte-tarefa.listar', $response->getName());
    }

    public function testCriarFunction()
    {
        // Criar uma instância do controlador
        $controller = new SuporteTarefaController();

        // Mock das classes User e SuporteTarefaStatus para simular o comportamento do Eloquent
        $userMock = $this->createMock(User::class);
        $statusMock = $this->createMock(SuporteTarefaStatus::class);

        // Mock da classe SuporteTarefa para simular a criação de uma nova tarefa
        $suporteTarefaMock = $this->createMock(SuporteTarefa::class);

        // Simular um usuário e status para o novo SuporteTarefa
        $userMock->expects($this->once())
            ->method('find')
            ->willReturnSelf();

        $statusMock->expects($this->once())
            ->method('find')
            ->willReturnSelf();

        // Substituir as instâncias reais por nossos mocks
        $controller->setUser($userMock);
        $controller->setStatus($statusMock);
        $controller->setSuporteTarefa($suporteTarefaMock);

        // Chamar a função 'criar'
        $response = $controller->criar();

        // Verificar se a resposta é uma instância de View
        $this->assertInstanceOf(View::class, $response);

        // Verificar se a view correta está sendo retornada
        $this->assertEquals('suporte-tarefa.criar', $response->getName());
    }
}
