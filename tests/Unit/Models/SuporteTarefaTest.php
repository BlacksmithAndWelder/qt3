<?php
use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

class SuporteTarefaTest extends TestCase
{
    public function test_status_method_returns_suporte_tarefa_status_relation()
    {
        // Criar um mock manual para SuporteTarefaStatus
        $suporteTarefaStatusMock = $this->createMock(SuporteTarefaStatus::class);

        // Criar uma instância de SuporteTarefa com a relação injetada
        $suporteTarefa = new SuporteTarefa(['status' => $suporteTarefaStatusMock]);

        // Chamar o método status
        $result = $suporteTarefa->status();

        // Verificar se o resultado é o mock de SuporteTarefaStatus
        $this->assertSame($suporteTarefaStatusMock, $result);
    }

    public function test_usuario_method_returns_user_relation()
    {
        // Criar um mock manual para User
        $userMock = $this->createMock(User::class);

        // Criar uma instância de SuporteTarefa com a relação injetada
        $suporteTarefa = new SuporteTarefa(['user' => $userMock]);

        // Chamar o método usuario
        $result = $suporteTarefa->usuario();

        // Verificar se o resultado é o mock de User
        $this->assertSame($userMock, $result);
    }
}
