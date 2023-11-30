<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\SuporteTarefa;

class UserTarefaTest extends TestCase
{
    public function testSuporteTarefasRelationship()
    {
        // Create a mock of the SuporteTarefa model
        $suporteTarefaMock = $this->createMock(SuporteTarefa::class);

        // Create a mock of the User model and set up the expectations for the hasMany relationship
        $userMock = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasMany'])
            ->getMock();

        // Expect the hasMany method to be called with specific arguments and return the SuporteTarefa mock
        $userMock->expects($this->once())
            ->method('hasMany')
            ->with(
                $this->equalTo(SuporteTarefa::class),
                $this->equalTo('user_id'),
                $this->equalTo('id')
            )
            ->willReturn($suporteTarefaMock);

        // Call the suporteTarefas method on the User model
        $result = $userMock->suporteTarefas();

        // Assert that the result is an instance of SuporteTarefa
        $this->assertInstanceOf(SuporteTarefa::class, $result);
    }
}
