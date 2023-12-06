<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Escola;
/**
 * @codeCoverageIgnore
 */
class EscolaTest extends TestCase
{   /**
    * @codeCoverageIgnore
    */
    /**
     * Verifica se as colunas do modelo Escola estão corretas.
     *
     * @return void
     */
    public function test_check_if_school_columns_are_correct()
    {
        $escola = new Escola;

        $expectedColumns = [
            'nome',
            'segmento',
            'endereco',
            'pais',
            'max_alunos'
        ];

        $fillableColumns = $escola->getFillable();

        // Verificar se todos os campos esperados estão no fillable
        foreach ($expectedColumns as $column) {
            $this->assertContains(
                $column,
                $fillableColumns,
                "A coluna '$column' está ausente de fillable."
            );
        }

        // Verificar se não há campos extras em fillable
        $extraColumns = array_diff($fillableColumns, $expectedColumns);
        $this->assertEmpty(
            $extraColumns,
            "Campos extras em fillable: " . implode(', ', $extraColumns)
        );
    }
}

