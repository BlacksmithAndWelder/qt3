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

        $fillableColumns = $suporteTarefa->getFillable();

        // Verificar se todos os campos esperados estão no fillable
        foreach ($expected as $column) {
            $this->assertContains($column, $fillableColumns, "A coluna '$column' está ausente de fillable.");
        }

        // Verificar se não há campos extras em fillable
        $extraColumns = array_diff($fillableColumns, $expected);
        $this->assertEmpty($extraColumns, "Campos extras em fillable: " . implode(', ', $extraColumns));
    }
}
