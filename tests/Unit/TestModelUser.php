<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\SuporteTarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testSuporteTarefasRelationship()
    {
        // Criar um usuário de exemplo
        $user = User::factory()->create();

        // Criar uma tarefa de suporte associada a esse usuário
        $suporteTarefa = SuporteTarefa::factory(['user_id' => $user->id])->create();

        // Chamar a relação e verificar se ela retorna uma instância de SuporteTarefa
        $this->assertInstanceOf(SuporteTarefa::class, $user->suporteTarefas->first());

        // Verificar se a tarefa de suporte associada é a mesma que criamos
        $this->assertEquals($suporteTarefa->id, $user->suporteTarefas->first()->id);
    }

    public function testFillableProperties()
    {
        // Definir dados para preencher o usuário
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
        ];

        // Criar uma instância de User
        $user = new User($data);

        // Verificar se os dados são preenchidos corretamente
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(\Hash::check('secret', $user->password));
    }

    // Adicione testes para outras funções, se necessário
}
