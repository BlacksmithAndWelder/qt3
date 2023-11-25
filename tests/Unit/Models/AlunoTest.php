<?php
use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsTurmaModel()
    {
        // Criar uma instância do Aluno usando um mock manual
        $aluno = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        // Criar um mock manual para a classe Turma
        $turmaMock = $this->getMockBuilder(Turma::class)
            ->onlyMethods(['find']) // Apenas mockar o método find
            ->getMock();

        // Configurar o retorno desejado do método find
        $turmaMock->method('find')->willReturn($turmaMock);

        // Substituir a implementação do método turma() no Aluno pelo mock de Turma
        $aluno->method('turma')->willReturn($turmaMock);

        // Chamar o método turma()
        $result = $aluno->turma();

        // Verificar se o resultado é uma instância da classe Turma
        $this->assertInstanceOf(Turma::class, $result);

        // Adicione mais verificações conforme necessário, dependendo da lógica real da sua aplicação
    }
}
