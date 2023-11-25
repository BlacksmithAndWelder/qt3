<?php
use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

class SuporteTarefaTest extends TestCase
{
    public function test_status_method_returns_suporte_tarefa_status_relation()
    {
        // Criar uma instância de SuporteTarefa
        $suporteTarefa = new SuporteTarefa();

        // Criar um mock manual para SuporteTarefaStatus
        $suporteTarefaStatusMock = $this->createMock(SuporteTarefaStatus::class);

        // Configurar manualmente a relação hasOne
        $suporteTarefa->setSuporteTarefaStatus($suporteTarefaStatusMock);

        // Chamar o método status
        $result = $suporteTarefa->status();

        // Verificar se o resultado é o mock de SuporteTarefaStatus
        $this->assertSame($suporteTarefaStatusMock, $result);
    }

    public function test_usuario_method_returns_user_relation()
    {
        // Criar uma instância de SuporteTarefa
        $suporteTarefa = new SuporteTarefa();

        // Criar um mock manual para User
        $userMock = $this->createMock(User::class);

        // Configurar manualmente a relação hasOne
        $suporteTarefa->setUser($userMock);

        // Chamar o método usuario
        $result = $suporteTarefa->usuario();

        // Verificar se o resultado é o mock de User
        $this->assertSame($userMock, $result);
    }
}
