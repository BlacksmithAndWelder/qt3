<?php
use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
/**
 * @codeCoverageIgnore
 */
class AlunoTest extends TestCase
{   
    /**
 * @codeCoverageIgnore
 */
    /**
     * Verifica se as colunas do Aluno estão corretas.
     *
     * @return void
     */
    public function test_check_if_aluno_columns_are_correct()
    {
        $aluno = new Aluno;
        $expected = [
            'nome',
            'sobrenome',
            'idade',
            'bolsa_estudos',
            'turma_id',
        ];

        $arrayCompared = array_diff($expected, $aluno->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
