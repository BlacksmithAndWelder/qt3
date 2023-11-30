<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\SuporteTarefaStatus;
use App\Models\SuporteTarefa;

class UserTest extends TestCase
{
    /**
     * Verifica se as colunas do modelo User estão corretas.
     *
     * @return void
     */
    public function test_check_if_user_columns_are_correct()
    {
        $user = new User;

        // Atributos fillable
        $fillableExpected = [
            'name',
            'email',
            'password',
        ];

        $fillableCompared = array_diff($fillableExpected, $user->getFillable());
        $this->assertCount(0, $fillableCompared, 'Algumas colunas fillable não correspondem às expectativas.');

        // Atributos hidden
        $hiddenExpected = [
            'password',
            'remember_token',
        ];

        $hiddenCompared = array_diff($hiddenExpected, $user->getHidden());
        $this->assertCount(0, $hiddenCompared, 'Algumas colunas hidden não correspondem às expectativas.');

        // Atributos casts
        $castsExpected = [
            'email_verified_at' => 'datetime',
        ];

        $castsCompared = array_diff_assoc($castsExpected, $user->getCasts());
        $this->assertCount(0, $castsCompared, 'Algumas colunas casts não correspondem às expectativas.');
    }

    public function testUSuporteTarefasRelationship()
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

