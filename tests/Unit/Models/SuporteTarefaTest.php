<?php
use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SuporteTarefaTest extends TestCase
{
    public function test_status_method_returns_suporte_tarefa_status_relation()
    {
        // Criar uma instância de SuporteTarefa
        $suporteTarefa = new SuporteTarefa;

        // Criar um mock manual para SuporteTarefaStatus
        $suporteTarefaStatusMock = $this->createMock(SuporteTarefaStatus::class);

        // Configurar o mock para o método hasOne
        $suporteTarefa->shouldReceive('status')
            ->once()
            ->andReturn($this->createMock(HasOne::class));

        // Chamar o método status
        $result = $suporteTarefa->status();

        // Verificar se o resultado é um mock de HasOne
        $this->assertInstanceOf(HasOne::class, $result);
    }

    public function test_usuario_method_returns_user_relation()
    {
        // Criar uma instância de SuporteTarefa
        $suporteTarefa = new SuporteTarefa;

        // Criar um mock manual para User
        $userMock = $this->createMock(User::class);

        // Configurar o mock para o método hasOne
        $suporteTarefa->shouldReceive('usuario')
            ->once()
            ->andReturn($this->createMock(HasOne::class));

        // Chamar o método usuario
        $result = $suporteTarefa->usuario();

        // Verificar se o resultado é um mock de HasOne
        $this->assertInstanceOf(HasOne::class, $result);
    }
}
