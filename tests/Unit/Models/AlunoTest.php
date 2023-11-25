<?php

use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsTurmaModel()
    {
        // Manually create an Aluno instance
        $aluno = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        // Chamar o método turma()
        $result = $aluno->turma();

        // Verificar se o resultado é uma instância da classe Turma
        $this->assertInstanceOf(Turma::class, $result);

        // Verificar se o ID da turma na instância de Aluno corresponde ao ID da Turma
        $this->assertEquals($aluno->turma_id, $result->id);

        // Adicione mais verificações conforme necessário, dependendo da lógica real da sua aplicação
    }
}
