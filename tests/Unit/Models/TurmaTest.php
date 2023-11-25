<?php
use PHPUnit\Framework\TestCase;
use App\Models\Turma;

class TurmaTest extends TestCase
{
    /**
     * Verifica se as colunas da Turma estão corretas.
     *
     * @return void
     */
    public function test_check_if_turma_columns_are_correct()
    {
        $turma = new Turma;
        $expected = [
            'escola_id',
            'ativo',
            'equipe',
            'sala',
        ];

        $arrayCompared = array_diff($expected, $turma->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
