<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Turma;
use App\Models\Escola;

class TurmaTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_properties()
    {
        $turma = new Turma();

        $this->assertEquals(['escola_id', 'ativo', 'equipe', 'sala'], $turma->getFillable());
    }

    /** @test */
    public function it_belongs_to_escola()
    {
        $turma = new Turma();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $turma->escola());
        $this->assertInstanceOf(Escola::class, $turma->escola()->getRelated());
    }
}
