<?php
use PHPUnit\Framework\TestCase;

// Importe a classe SuporteTarefa aqui se estiver em um namespace diferente
// use Caminho\Para\SuporteTarefa;

class SuporteTarefaTest extends TestCase
{
    public function test_status_method_returns_suporte_tarefa_status_relation()
    {
        // Criar um mock manual para SuporteTarefaStatus
        $suporteTarefaStatusMock = $this->getMockBuilder('SuporteTarefaStatus')
            ->disableOriginalConstructor()
            ->getMock();

        // Criar uma instância de SuporteTarefa com o mock injetado
        $suporteTarefa = new SuporteTarefa();

        // Substituir o método hasOne com a implementação do mock
        $suporteTarefa->hasOne = function ($class, $foreignKey, $localKey) use ($suporteTarefaStatusMock) {
            // Verificar se os parâmetros são corretos
            $this->assertEquals(SuporteTarefaStatus::class, $class);
            $this->assertEquals('id', $foreignKey);
            $this->assertEquals('status_id', $localKey);

            // Retornar o mock de SuporteTarefaStatus
            return $suporteTarefaStatusMock;
        };

        // Chamar o método status
        $result = $suporteTarefa->status();

        // Verificar se o resultado é o mock de SuporteTarefaStatus
        $this->assertSame($suporteTarefaStatusMock, $result);
    }
}
