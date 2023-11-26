<?php
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ApitTest extends TestCase
{
    public function testApiRouteReturnsUsers()
    {
        // Faz um mock do facade DB para simular o acesso ao banco de dados
        $dbMock = $this->getMockBuilder('Illuminate\Database\Query\Builder')
            ->disableOriginalConstructor()
            ->getMock();

        // Configura a expectativa para o método select
        $dbMock->expects($this->once())
            ->method('select')
            ->with('users.*')
            ->willReturn([['user' => 'mocked_user']]);

        // Substitui a implementação do facade DB pelo mock
        DB::shouldReceive('table')->with('users')->andReturn($dbMock);

        // Simula uma requisição GET para a rota /api/user
        $response = $this->get('/api/user');

        // Verifica se a resposta tem o código HTTP 200 (OK)
        $response->assertStatus(200);

        // Verifica se a resposta é um JSON contendo a chave 'user'
        $response->assertJson([['user' => 'mocked_user']]);

        // Outras asserções específicas podem ser adicionadas conforme necessário
    }
}

