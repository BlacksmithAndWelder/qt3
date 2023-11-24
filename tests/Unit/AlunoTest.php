use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AlunoTest extends TestCase {
    
    /**
     * @codeCoverageIgnore
     */
    public function testTurmaMethodReturnsHasOneRelation() {
        // Criar uma instância de Aluno
        $aluno = new Aluno([
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
