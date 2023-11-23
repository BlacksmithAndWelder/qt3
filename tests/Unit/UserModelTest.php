<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\SuporteTarefa;
use Mockery;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testSuporteTarefasRelationship()
    {
        // Criar um mock para a classe SuporteTarefa
        $suporteTarefaMock = Mockery::mock(SuporteTarefa::class);

        // Definir expectativas no mock
        $suporteTarefaMock->shouldReceive('algumMetodo')->andReturn('algum_valor');

        // Criar uma instância da classe User, substituindo o método hasMany pelo mock criado
        $user = new User();

        // Associar o mock ao método suporteTarefas
        $user->setRelation('suporteTarefas', $suporteTarefaMock);

        // Verificar se a relação foi corretamente definida
        $this->assertTrue($user->relationLoaded('suporteTarefas'));

        // Obter a relação e verificar se ela é do tipo SuporteTarefa
        $relationship = $user->suporteTarefas();
        $this->assertInstanceOf(SuporteTarefa::class, $relationship->getRelated());

        // Testar qualquer lógica adicional relacionada à relação
        // ...

        // Chamar o método simulado no mock e verificar o resultado
        $result = $relationship->getRelated()->algumMetodo();
        $this->assertEquals('algum_valor', $result);
    }

    public function testCasts()
    {
        // Testar conversão de tipos
        $user = new User([
            'email_verified_at' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $user->email_verified_at);
    }

    // Adicione testes adicionais para outras funções da classe User, se necessário
}