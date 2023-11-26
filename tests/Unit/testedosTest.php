<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Mockery\MockInterface;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Configuração e criação do mock para DB facade
        $this->mockDatabase = $this->mock(DB::class, function (MockInterface $mock) {
            $queryBuilderMock = $this->mock('alias:' . Illuminate\Database\Query\Builder::class);
            $queryBuilderMock->shouldReceive('select')->andReturnSelf(); // Pode adicionar outras expectativas conforme necessário
            $mock->shouldReceive('table')->andReturn($queryBuilderMock);
        });
    }

    public function testApiRoute()
    {
        // Simula uma requisição GET para a rota /api/user
        $response = $this->get('/api/user');

        // Verifica se a resposta tem o código HTTP 200 (OK)
        $response->assertStatus(200);

        // Verifica se a resposta é um JSON contendo a chave 'user'
        $response->assertJson(['user' => 'mocked_user']);

        // Outras asserções específicas podem ser adicionadas conforme necessário
    }
}
