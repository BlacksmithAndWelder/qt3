<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

class SuporteTarefaTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_properties()
    {
        $tarefa = new SuporteTarefa();

        $this->assertEquals(['status_id', 'user_id', 'assunto', 'descricao', 'urgente', 'created_at', 'updated_at'], $tarefa->getFillable());
    }

    /** @test */
    public function it_belongs_to_status()
    {
        $tarefa = new SuporteTarefa();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $tarefa->status());
        $this->assertInstanceOf(SuporteTarefaStatus::class, $tarefa->status()->getRelated());
    }

    /** @test */
    public function it_belongs_to_usuario()
    {
        $tarefa = new SuporteTarefa();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $tarefa->usuario());
        $this->assertInstanceOf(User::class, $tarefa->usuario()->getRelated());
    }
}
