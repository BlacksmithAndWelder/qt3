<?php

namespace Tests\Unit;
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

        // Restante do teste permanece inalterado
        $result = $aluno->turma();
        $this->assertInstanceOf(HasOne::class, $result);
        $this->assertInstanceOf(Turma::class, $result->getRelated());
        $this->assertEquals('turma_id', $result->getForeignKeyName());
        $this->assertEquals('id', $result->getLocalKeyName());
    }
}
