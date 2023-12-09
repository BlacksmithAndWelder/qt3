<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_properties()
    {
        $aluno = new Aluno();

        $this->assertEquals(['nome', 'sobrenome', 'idade', 'bolsa_estudos', 'turma_id'], $aluno->getFillable());
    }

    /** @test */
    public function it_belongs_to_turma()
    {
        $aluno = new Aluno();

        $this->assertInstanceOf(Turma::class, $aluno->turma());
    }
}
