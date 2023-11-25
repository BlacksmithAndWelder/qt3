<?php

use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Container\Container;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;

class AlunoTest extends TestCase
{
    public function testTurmaMethodReturnsTurmaModel()
    {
        // Mock the Eloquent builder and connection
        $builder = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $connection = $this->getMockBuilder('Illuminate\Database\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        // Create a mock Container instance
        $container = new Container();

        // Set up a mock event dispatcher
        $dispatcher = new Dispatcher($container);

        // Set up the Eloquent model with the mocked connection
        $resolver = new ConnectionResolver(['default' => $connection]);
        Model::setConnectionResolver($resolver);

        // Manually create an Aluno instance with valid data
        $alunoData = [
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ];

        $aluno = new Aluno($alunoData);

        // Print some debug information
        var_dump($alunoData); // Output 1
        var_dump($aluno->toArray()); // Output 2

        // Chamar o método turma()
        $result = $aluno->turma();

        // Verificar se o resultado é uma instância da classe Turma
        $this->assertInstanceOf(Turma::class, $result);

        // Verificar se o ID da turma na instância de Aluno corresponde ao ID da Turma
        $this->assertEquals($aluno->turma_id, $result->id);

        // Adicione mais verificações conforme necessário, dependendo da lógica real da sua aplicação
    }
}
