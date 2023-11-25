<?php

use PHPUnit\Framework\TestCase;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlunoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set up the Eloquent model with a simple factory
        Model::setConnectionResolver(
            $resolver = new \Illuminate\Database\ConnectionResolver
        );

        $resolver->addConnection('default', $this->createMock('Illuminate\Database\Connection'));

        // Set up a mock Container instance
        $container = new Container();

        // Set up the Eloquent model event dispatcher with the correct container type
        Model::setEventDispatcher(
            new \Illuminate\Events\Dispatcher($container)
        );

        // Ensure the Aluno model has the HasFactory trait
        if (!in_array(HasFactory::class, class_uses_recursive(Aluno::class))) {
            Aluno::addTrait(HasFactory::class);
        }

        // Manually register the factory
        $this->app = Container::getInstance();
        $this->app->instance(
            Factory::class,
            new Factory($this->app->make('Illuminate\Database\Eloquent\Factory'))
        );
    }

    public function testTurmaMethodReturnsTurmaModel()
    {
        // Manually create an Aluno instance with valid data
        $alunoData = [
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'idade' => 20,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ];

        $aluno = Aluno::factory()->make($alunoData);

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
