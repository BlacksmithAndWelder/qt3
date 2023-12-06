<?php

use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefaStatus;
/**
 * @codeCoverageIgnore
 */

class SuporteTarefaStatusTest extends TestCase
{   /**
    * @codeCoverageIgnore
    */
    /**
     * Verifica se as colunas do modelo SuporteTarefaStatus estão corretas.
     *
     * @return void
     */
    public function test_check_if_suporte_tarefa_status_columns_are_correct()
    {
        $status = new SuporteTarefaStatus;
        $expected = [
            'nome',
        ];

        $arrayCompared = array_diff($expected, $status->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
