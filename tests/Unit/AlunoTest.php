<?php

namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\View\Factory as ViewFactory; // Importe a classe ViewFactory

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsHasOneRelation()
    {
        // Crie um mock para a classe ViewFactory
        $viewFactory = $this->createMock(ViewFactory::class);

        // Passe o mock da classe ViewFactory para o construtor da classe View
        $aluno = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ], $viewFactory); // Passe a instância de ViewFactory para o construtor

        // Restante do teste permanece inalterado
        $result = $aluno->turma();
        $this->assertInstanceOf(HasOne::class, $result);
        $this->assertInstanceOf(Turma::class, $result->getRelated());
        $this->assertEquals('turma_id', $result->getForeignKeyName());
        $this->assertEquals('id', $result->getLocalKeyName());
    }
}
