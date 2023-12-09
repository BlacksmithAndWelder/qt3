<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\SuporteTarefa;

class UserTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_properties()
    {
        $user = new User();

        $this->assertEquals(['name', 'email', 'password'], $user->getFillable());
    }

    /** @test */
    public function it_has_hidden_attributes()
    {
        $user = new User();

        $this->assertEquals(['password', 'remember_token'], $user->getHidden());
    }

    /** @test */
    public function it_has_casted_attributes()
    {
        $user = new User();

        $this->assertEquals(['email_verified_at' => 'datetime'], $user->getCasts());
    }

    /** @test */
    public function it_has_many_suporte_tarefas()
    {
        $user = new User();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $user->suporteTarefas());
        $this->assertInstanceOf(SuporteTarefa::class, $user->suporteTarefas()->getRelated());
    }
}
