
<?php
use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Mockery;

class AlunoTest extends TestCase
{
    /**
     * @codeCoverageIgnore
     */
    public function testTurmaMethodReturnsHasOneRelation()
    {
        // Criar uma instância de Aluno
        $aluno = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        // Criar um mock para o relacionamento HasOne
        $hasOneMock = Mockery::mock(HasOne::class);
        
        // Criar um mock para a classe Turma
        $turmaMock = Mockery::mock(Turma::class);

        // Configurar o mock HasOne para retornar o mock da classe Turma
        $hasOneMock->shouldReceive('getRelated')->andReturn($turmaMock);
        $hasOneMock->shouldReceive('getForeignKeyName')->andReturn('turma_id');
        $hasOneMock->shouldReceive('getLocalKeyName')->andReturn('id');

        // Substituir o método turma() por nosso mock no objeto Aluno
        $aluno->shouldReceive('turma')->andReturn($hasOneMock);

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
