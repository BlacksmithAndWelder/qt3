<?php
use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsTurmaRelation()
    {
        // Dados específicos do Aluno
        $alunoData = [
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ];

        // Criar uma instância do Aluno usando um mock manual
        $aluno = $this->getMockBuilder(Aluno::class)
            ->setConstructorArgs([$alunoData])
            ->getMock();

        // Dados específicos da Turma
        $turmaData = [
            'escola_id' => 1,
            'ativo' => true,
            'equipe' => 'A',
            'sala' => '101',
        ];

        // Criar um mock manual para a classe Turma
        $turmaMock = $this->getMockBuilder(Turma::class)
            ->setConstructorArgs([$turmaData])
            ->getMock();

        // Substituir a implementação do método turma() no Aluno pelo mock de Turma
        $aluno->method('turma')->willReturn($turmaMock);

        // Chamar o método turma()
        $result = $aluno->turma();

        // Verificar se o resultado é uma instância da relação HasOne
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $result);

        // Adicione mais verificações conforme necessário, dependendo da lógica real da sua aplicação
    }
}
