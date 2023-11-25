<?php
use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefa;

class SuporteTarefaTest extends TestCase
{
    /**
     * Verifica se as colunas do modelo SuporteTarefa estão corretas.
     *
     * @return void
     */
    public function test_check_if_suporte_tarefa_columns_are_correct()
    {
        $suporteTarefa = new SuporteTarefa;
        $expected = [
            'status_id',
            'user_id',
            'assunto',
            'descricao',
            'urgente',
            'created_at',
            'updated_at',
        ];

        $arrayCompared = array_diff($expected, $suporteTarefa->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
