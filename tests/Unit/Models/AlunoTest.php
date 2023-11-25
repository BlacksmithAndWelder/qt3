<?php

namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Events\Dispatcher;

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsTurmaModel()
    {
        // Mock the Eloquent builder and connection
        $builder = $this->getMockBuilder('Illuminate\Database\Eloquent\Builder')
            ->disableOriginalConstructor()
            ->getMock();

        $connection = $this->getMockBuilder('Illuminate\Database\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        // Create a mock Container instance
        $container = $this->getMockBuilder('Illuminate\Contracts\Container\Container')
            ->getMock();

        // Set up a mock event dispatcher
        $dispatcher = new Dispatcher($container);

        // Set the mocked connection on the Aluno model
        Aluno::setConnectionResolver($resolver = new \Illuminate\Database\ConnectionResolver);
        $resolver->addConnection('default', $connection);
        Aluno::setEventDispatcher($dispatcher);

        // Manually create an Aluno instance
        $alunoData = [
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => '20',
            'bolsa_estudos' => 'sim',
            'turma_id' => '1',
        ];

        // Print the data being used
        var_dump($alunoData);

        $aluno = new Aluno($alunoData);

        // Ensure that the properties and methods used in your test are defined in the Aluno model

        // Chamar o método turma()
        $result = $aluno->turma();

        // Verificar se o resultado é uma instância da classe Turma
        $this->assertInstanceOf(Turma::class, $result);

        // Verificar se o ID da turma na instância de Aluno corresponde ao ID da Turma
        $this->assertEquals($aluno->turma_id, $result->id);

        // Adicione mais verificações conforme necessário, dependendo da lógica real da sua aplicação
    }
}
