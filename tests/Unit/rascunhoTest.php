<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuporteTarefatesteTest extends TestCase
{
    use RefreshDatabase;

    public function testItHasStatusRelationship()
    {
        $suporteTarefa = SuporteTarefa::factory()->create();
        
        $this->assertInstanceOf(SuporteTarefaStatus::class, $suporteTarefa->status);
    }

    public function testItHasUsuarioRelationship()
    {
        $suporteTarefa = SuporteTarefa::factory()->create();
        
        $this->assertInstanceOf(User::class, $suporteTarefa->usuario);
    }

    public function testItIsFillable()
    {
        $fillable = ['status_id', 'user_id', 'assunto', 'descricao', 'urgente', 'created_at', 'updated_at'];
        $suporteTarefa = new SuporteTarefa();

        $this->assertEquals($fillable, $suporteTarefa->getFillable());
    }

    // Add more tests as needed based on your application requirements
}