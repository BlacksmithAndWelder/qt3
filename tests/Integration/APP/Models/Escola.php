<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Escola;

class EscolaTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_properties()
    {
        $escola = new Escola();

        $this->assertEquals(['nome', 'segmento', 'endereco', 'pais', 'max_alunos'], $escola->getFillable());
    }
}
