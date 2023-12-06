<?php



use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
/**
 * @codeCoverageIgnore
 */
class AlunoFTurmaTest extends TestCase
{   
   /**
 * @codeCoverageIgnore
 */
    public function testTurmaRelationship()
    {
        // Create a mock of the Turma model
        $turmaMock = $this->createMock(Turma::class);

        // Create a mock of the Aluno model and set up the expectations for the hasOne relationship
        $alunoMock = $this->getMockBuilder(Aluno::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasOne'])
            ->getMock();

        // Expect the hasOne method to be called with specific arguments and return the Turma mock
        $alunoMock->expects($this->once())
            ->method('hasOne')
            ->with(
                $this->equalTo(Turma::class),
                $this->equalTo('id'),
                $this->equalTo('turma_id')
            )
            ->willReturn($turmaMock);

        // Call the turma method on the Aluno model
        $result = $alunoMock->turma();

        // Assert that the result is an instance of Turma
        $this->assertInstanceOf(Turma::class, $result);
    }
}
