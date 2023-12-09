<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Nasa\NasaController;
use Mockery;

class NasaControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testDetalheComSucesso()
    {
        // "Mocar" (mock) a resposta da API
        $responseBody = json_encode(['title' => 'Teste', 'explanation' => 'Descrição de teste']);
        $httpMock = Mockery::mock('overload:' . Http::class);
        $httpMock->shouldReceive('get')->andReturn((object)['body' => $responseBody]);

        // Executar a função detalhe do controlador
        $controller = new NasaController();
        $response = $controller->detalhe();

        // Verificar se a view é a esperada
        $this->assertEquals('nasa.detalhe', $response->getName());

        // Verificar se a variável NasaDetalhe está definida na view
        $this->assertArrayHasKey('NasaDetalhe', $response->getData());

        // Verificar se a variável NasaDetalhe contém os dados esperados
        $this->assertEquals('Teste', $response->getData()['NasaDetalhe']->title);
        $this->assertEquals('Descrição de teste', $response->getData()['NasaDetalhe']->explanation);
    }

    public function testDetalheComErro()
    {
        // "Mocar" (mock) uma exceção ao chamar a API
        $httpMock = Mockery::mock('overload:' . Http::class);
        $httpMock->shouldReceive('get')->andThrow(new \Exception('Erro na requisição'));

        // Executar a função detalhe do controlador
        $controller = new NasaController();
        $response = $controller->detalhe();

        // Verificar se a view é a esperada
        $this->assertEquals('nasa.detalhe', $response->getName());

        // Verificar se as variáveis de sessão foram definidas corretamente
        $this->assertEquals('danger', $controller->getSession('classe'));
        $this->assertEquals('Não foi possível realizar requisição API -Nasa!', $controller->getSession('mensagem'));
    }
}
