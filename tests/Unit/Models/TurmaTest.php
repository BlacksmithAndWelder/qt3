<?php

use PHPUnit\Framework\TestCase;
use App\Models\Turma;
use App\Models\Escola;

class TurmaTest extends TestCase
{
    /**
     * Verifica se as colunas da Turma estão corretas.
     *
     * @return void
     */
    public function test_check_if_turma_columns_are_correct()
    {
        $turma = new Turma;
        $expected = [
            'escola_id',
            'ativo',
            'equipe',
            'sala',
        ];

        $arrayCompared = array_diff($expected, $turma->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }

    public function testEscolaRelationship()
    {
        // Create a mock of the Escola model
        $escolaMock = $this->createMock(Escola::class);

        // Create a mock of the Turma model and set up the expectations for the hasOne relationship
        $turmaMock = $this->getMockBuilder(Turma::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasOne'])
            ->getMock();

        // Expect the hasOne method to be called with specific arguments and return the Escola mock
        $turmaMock->expects($this->once())
            ->method('hasOne')
            ->with(
                $this->equalTo(Escola::class),
                $this->equalTo('id'),
                $this->equalTo('escola_id')
            )
            ->willReturn($escolaMock);

        // Call the escola method on the Turma model
        $result = $turmaMock->escola();

        // Assert that the result is an instance of Escola
        $this->assertInstanceOf(Escola::class, $result);
    }
}
