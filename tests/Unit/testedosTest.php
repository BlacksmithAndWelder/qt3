<?php
use App\Models\SuporteTarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class STCTest extends TestCase
{
    use RefreshDatabase; // Usar o trait RefreshDatabase para resetar o banco de dados a cada teste

    public function testListarFunction()
    {
        // Criar algumas tarefas no banco de dados de teste
        SuporteTarefa::factory()->count(2)->create();

        // Chamar a rota que corresponde à função 'listar'
        $response = $this->get(route('suporte-tarefa.listar'));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.listar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.listar');

        // Verificar se a view tem a variável 'ListaSuporteTarefa' que contém as tarefas do banco de dados
        $response->assertViewHas('ListaSuporteeTarefa');
    }
}
