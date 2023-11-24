
use Tests\TestCase;
use App\Models\Turma;
use App\Models\Escola;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TurmaTest extends TestCase
{
    use RefreshDatabase;

    public function testEscolaRelationship()
    {
        // Criar uma escola de exemplo
        $escola = Escola::factory()->create();

        // Criar uma turma associada a essa escola
        $turma = Turma::factory(['escola_id' => $escola->id])->create();

        // Chamar a relação e verificar se ela retorna uma instância de Escola
        $this->assertInstanceOf(Escola::class, $turma->escola);

        // Verificar se a escola associada é a mesma que criamos
        $this->assertEquals($escola->id, $turma->escola->id);
    }

    public function testFillableProperties()
    {
        // Definir dados para preencher a turma
        $data = [
            'escola_id' => 1,
            'ativo' => true,
            'equipe' => 'Equipe A',
            'sala' => 'Sala 101',
        ];

        // Criar uma instância de Turma
        $turma = new Turma($data);

        // Verificar se os dados são preenchidos corretamente
        $this->assertEquals($data['escola_id'], $turma->escola_id);
        $this->assertEquals($data['ativo'], $turma->ativo);
        $this->assertEquals($data['equipe'], $turma->equipe);
        $this->assertEquals($data['sala'], $turma->sala);
    }

    // Adicione testes para outras funções, se necessário
}
