<?php

use PHPUnit\Framework\TestCase;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User;

/**
 * @codeCoverageIgnore
 */
class SuporteTarefaTest extends TestCase
{
    /**
     * Verifica se as colunas do modelo SuporteTarefa estão corretas.
     *
     * @return void
     */
    public function test_check_if_suporte_tarefa_columns_are_correct()
    {
        $suporteTarefa = new SuporteTarefa;

        $expected = [
            'status_id',
            'user_id',
            'assunto',
            'descricao',
            'urgente',
            'created_at',
            'updated_at',
        ];

        $fillableColumns = $suporteTarefa->getFillable();

        // Verificar se todos os campos esperados estão no fillable
        foreach ($expected as $column) {
            $this->assertContains($column, $fillableColumns, "A coluna '$column' está ausente de fillable.");
        }

        // Verificar se não há campos extras em fillable
        $extraColumns = array_diff($fillableColumns, $expected);
        $this->assertEmpty($extraColumns, "Campos extras em fillable: " . implode(', ', $extraColumns));
    }

    public function testStatusRelationship()
    {
        // Create a mock of the SuporteTarefaStatus model
        $suporteTarefaStatusMock = $this->createMock(SuporteTarefaStatus::class);

        // Create a mock of the SuporteTarefa model and set up the expectations for the hasOne relationship
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasOne'])
            ->getMock();

        // Expect the hasOne method to be called with specific arguments and return the SuporteTarefaStatus mock
        $suporteTarefaMock->expects($this->once())
            ->method('hasOne')
            ->with(
                $this->equalTo(SuporteTarefaStatus::class),
                $this->equalTo('id'),
                $this->equalTo('status_id')
            )
            ->willReturn($suporteTarefaStatusMock);

        // Call the status method on the SuporteTarefa model
        $result = $suporteTarefaMock->status();

        // Assert that the result is an instance of SuporteTarefaStatus
        $this->assertInstanceOf(SuporteTarefaStatus::class, $result);
    }

    public function testUsuarioRelationship()
    {
        // Create a mock of the User model
        $userMock = $this->createMock(User::class);

        // Create a mock of the SuporteTarefa model and set up the expectations for the hasOne relationship
        $suporteTarefaMock = $this->getMockBuilder(SuporteTarefa::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasOne'])
            ->getMock();

        // Expect the hasOne method to be called with specific arguments and return the User mock
        $suporteTarefaMock->expects($this->once())
            ->method('hasOne')
            ->with(
                $this->equalTo(User::class),
                $this->equalTo('id'),
                $this->equalTo('user_id')
            )
            ->willReturn($userMock);

        // Call the usuario method on the SuporteTarefa model
        $result = $suporteTarefaMock->usuario();

        // Assert that the result is an instance of User
        $this->assertInstanceOf(User::class, $result);
    }
}
