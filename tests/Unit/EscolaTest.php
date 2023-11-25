<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Escola;


class EscolaTest extends TestCase
{
    /**
     * @codeCoverageIgnore
     * A basic test Escola.
     *
     * @return void
     */
   public function test_check_if_school_column_is_correct(){
        $escola = new Escola;
        $expected = [
            'nome',
            'segmento',
            'endereco',
            'pais',
            'max_alunos'
        ];

        $arrayCompared = array_diff($expected, $escola->getFillable());
       
        return $this->assertEquals(0, count($arrayCompared));
    }
}

