<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testApiRoute()
    {
        // Faz o mock do facade DB para simular o acesso ao banco de dados
        DB::shouldReceive('table')
            ->once()
            ->with('users')
            ->andReturn(['user' => 'mocked_user']);

        // Simula uma requisição GET para a rota /api/user
        $response = $this->get('/api/user');

        // Verifica se a resposta tem o código HTTP 200 (OK)
        $response->assertStatus(200);

        // Verifica se a resposta é um JSON contendo a chave 'user'
        $response->assertJson(['user' => 'mocked_user']);

        // Outras asserções específicas podem ser adicionadas conforme necessário
    }
}
