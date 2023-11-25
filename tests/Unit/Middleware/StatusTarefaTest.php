<?php
use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefaStatus;
use App\Models\SuporteTarefa;

class StatusSuporteTarefaStatusTest extends TestCase
{
    public function testSuporteTarefasRelationship()
    {
        // Create a mock of the SuporteTarefa model
        $suporteTarefaMock = $this->createMock(SuporteTarefa::class);

        // Create a mock of the SuporteTarefaStatus model and set up the expectations for the hasMany relationship
        $suporteTarefaStatusMock = $this->getMockBuilder(SuporteTarefaStatus::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasMany'])
            ->getMock();

        // Expect the hasMany method to be called with specific arguments and return the SuporteTarefa mock
        $suporteTarefaStatusMock->expects($this->once())
            ->method('hasMany')
            ->with(
                $this->equalTo(SuporteTarefa::class),
                $this->equalTo('status_id'),
                $this->equalTo('id')
            )
            ->willReturn($suporteTarefaMock);

        // Call the suporteTarefas method on the SuporteTarefaStatus model
        $result = $suporteTarefaStatusMock->suporteTarefas();

        // Assert that the result is an instance of SuporteTarefa
        $this->assertInstanceOf(SuporteTarefa::class, $result);
    }
}
