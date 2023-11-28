<?php
use Tests\TestCase;
#  use PHPUnit\Framework\TestCase;
use App\Models\Turma;

class TurmaControllerTest extends TestCase
{
    public function testListar()
    {
        // Criar um mock manual para a classe Turma
        $mockTurma = $this->getMockBuilder(Turma::class)
            ->onlyMethods(['with', 'toArray']) // Adicione outros métodos que você espera chamar
            ->getMock();
        
        $mockTurma->expects($this->once())
            ->method('with')
            ->willReturnSelf();

        $mockTurma->expects($this->once())
            ->method('toArray')
            ->willReturn(['item1', 'item2', 'item3']); // Pode ajustar para refletir o formato real do retorno

        // Criar uma instância do controlador passando o mockTurma
        $controller = new TurmaController($mockTurma);

        // Chama diretamente o método a ser testado, evitando a resolução automática de dependências
        $view = $controller->listar();

        // Faz as asserções dos resultados
        $this->assertEquals('turma.listar', $view->name());
        $this->assertEquals(['item1', 'item2', 'item3'], $view->getData()['ListaTurma']);
    }
}
