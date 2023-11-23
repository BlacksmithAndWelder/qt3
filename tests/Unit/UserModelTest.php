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
        $suporteTarefaMock->shouldReceive('exemplo')->andReturn('algum_valor');

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

        // Chamar o método 'exemplo' no mock e verificar o resultado
        $result = $relationship->getRelated()->exemplo();
        $this->assertEquals('algum_valor', $result);

        // Criar um objeto SuporteTarefa simulado
        $suporteTarefaSimulado = new SuporteTarefa(['atributo' => 'valor']);

        // Simular a adição da SuporteTarefa ao usuário
        $user->getRelation('suporteTarefas')->add($suporteTarefaSimulado);

        // Verificar se a relação é uma coleção Eloquent e contém o objeto SuporteTarefa simulado
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $user->suporteTarefas);
        $this->assertTrue($user->suporteTarefas->contains($suporteTarefaSimulado));
    }

    public function testMassAssignment()
    {
        // Testar atributos que podem ser preenchidos em massa
        $user = new User([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertEquals('secret', $user->password);
    }

    public function testHiddenAttributes()
    {
        // Testar atributos ocultos durante a serialização
        $user = new User([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'remember_token' => 'token',
        ]);

        $hiddenAttributes = $user->toArray();

        $this->assertArrayNotHasKey('password', $hiddenAttributes);
        $this->assertArrayNotHasKey('remember_token', $hiddenAttributes);
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