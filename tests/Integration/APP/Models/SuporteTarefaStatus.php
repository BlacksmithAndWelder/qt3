<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\SuporteTarefaStatus;
use App\Models\SuporteTarefa;

class SuporteTarefaStatusTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_properties()
    {
        $status = new SuporteTarefaStatus();

        $this->assertEquals(['nome'], $status->getFillable());
    }

    /** @test */
    public function it_has_many_suporte_tarefas()
    {
        $status = new SuporteTarefaStatus();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $status->suporteTarefas());
        $this->assertInstanceOf(SuporteTarefa::class, $status->suporteTarefas()->getRelated());
    }
}
