<?php

use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsHasOneRelation()
    {
        // Use a Factory do Eloquent para criar instâncias sem interação com o banco de dados
        $aluno = Aluno::factory()->make([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        // Chamar o método turma()
        $result = $aluno->turma();

        // Verificar se o resultado é uma instância de HasOne (relacionamento Eloquent)
        $this->assertInstanceOf(HasOne::class, $result);
        
        // Verificar se o modelo de destino é a classe Turma
        $this->assertInstanceOf(Turma::class, $result->getRelated());
        
        // Verificar se as chaves estrangeira e local estão corretas
        $this->assertEquals('turma_id', $result->getForeignKeyName());
        $this->assertEquals('id', $result->getLocalKeyName());
    }
}
