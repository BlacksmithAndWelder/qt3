<?php

namespace Tests\Unit\Models;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
    use DatabaseTransactions;

    public function tearDown(): void
    {
        m::close();
    }

    public function testTurmaRelacionamento()
    {
        // Criar uma instância mock da classe Turma
        $turmaMock = m::mock(Turma::class);

        // Definir o comportamento esperado para o método hasOne
        $aluno = new Aluno();
        $aluno->shouldReceive('hasOne')->with(Turma::class, 'id', 'turma_id')->andReturn($turmaMock);

        // Chamar o método turma() e verificar se ele retorna o mock da turma
        $result = $aluno->turma();

        $this->assertInstanceOf(Turma::class, $result);
    }
}
