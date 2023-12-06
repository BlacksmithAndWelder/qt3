<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;
use Mockery;

class SuporteTarefaTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testItHasStatusRelationship()
    {
        // Create a mock for SuporteTarefaStatus
        $statusMock = Mockery::mock(SuporteTarefaStatus::class);

        // Expect a call to status relationship
        $statusMock->shouldReceive('status')->once()->andReturn($statusMock);

        // Create a SuporteTarefa instance with the mocked status relationship
        $suporteTarefa = new SuporteTarefa();
        $this->mockRelationship($suporteTarefa, 'status', $statusMock);

        // Perform the test
        $this->assertInstanceOf(SuporteTarefaStatus::class, $suporteTarefa->status);
    }

    public function testItHasUsuarioRelationship()
    {
        // Create a mock for User
        $userMock = Mockery::mock(User::class);

        // Expect a call to usuario relationship
        $userMock->shouldReceive('usuario')->once()->andReturn($userMock);

        // Create a SuporteTarefa instance with the mocked usuario relationship
        $suporteTarefa = new SuporteTarefa();
        $this->mockRelationship($suporteTarefa, 'usuario', $userMock);

        // Perform the test
        $this->assertInstanceOf(User::class, $suporteTarefa->usuario);
    }

    public function testItIsFillable()
    {
        $fillable = ['status_id', 'user_id', 'assunto', 'descricao', 'urgente', 'created_at', 'updated_at'];
        $suporteTarefa = new SuporteTarefa();

        $this->assertEquals($fillable, $suporteTarefa->getFillable());
    }

    protected function mockRelationship($instance, $relationship, $mock)
    {
        $reflection = new \ReflectionClass($instance);
        $property = $reflection->getProperty($relationship);
        $property->setAccessible(true);
        $property->setValue($instance, $mock);
    }
}
