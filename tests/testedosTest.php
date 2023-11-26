<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SuporteTarefaControllerTest extends TestCase
{
    use RefreshDatabase; // Este trait reinicia o banco de dados entre os testes

    public function testListarFunction()
    {
        // Criar alguns dados de teste no banco de dados
        $suporteTarefa = SuporteTarefa::factory()->create([
            'assunto' => 'Assunto 1',
            'descricao' => 'Descrição 1',
        ]);

        // Chamar a rota que corresponde à função 'listar'
        $response = $this->get(route('suporte-tarefa.listar'));

        // Verificar se a resposta contém o status HTTP 200 (OK)
        $response->assertStatus(200);

        // Verificar se a view 'suporte-tarefa.listar' está sendo retornada
        $response->assertViewIs('suporte-tarefa.listar');

        // Verificar se os dados da tarefa de suporte estão presentes na view
        $response->assertViewHas('ListaSuporteTarefa', function ($lista) use ($suporteTarefa) {
            return $lista->contains($suporteTarefa);
        });
    }
}
