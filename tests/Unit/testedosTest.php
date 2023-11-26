<?php

/**
 * @codeCoverageIgnore
 */
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Models\Aluno;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\Factory;
use Mockery\MockInterface;
use Tests\TestCase;

class AlunoControllerTest extends TestCase
{
    public function testListarRetornaViewComListaDeAlunos()
    {
        // Arrange
        $aluno1 = new Aluno([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $aluno2 = new Aluno([
            'nome' => 'Maria',
            'sobrenome' => 'Santos',
            'idade' => 22,
            'bolsa_estudos' => false,
            'turma_id' => 2,
        ]);

        $alunoController = $this->getMockBuilder(AlunoController::class)
            ->onlyMethods(['getAlunosFromDatabase'])
            ->getMock();

        $alunoController->expects($this->once())
            ->method('getAlunosFromDatabase')
            ->willReturn(new Collection([$aluno1, $aluno2]));

        // Act
        $response = $alunoController->listar();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertInstanceOf(Factory::class, $response->getFactory());
        $this->assertEquals('aluno.listar', $response->name());

        // You can add more assertions based on your specific use case.
    }
}
