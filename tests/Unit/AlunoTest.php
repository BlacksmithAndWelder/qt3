// AlunoTest.php

use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoTest extends TestCase {
    public function testTurmaMethodReturnsTurmaInstance() {
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

        // Verificar se o resultado é uma instância válida de Turma
        $this->assertInstanceOf(Turma::class, $result);
    }
}
