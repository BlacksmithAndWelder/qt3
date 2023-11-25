<?php

namespace Tests\Unit;
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

trait ResourcePathTrait
{
    public function resourcePath($path)
    {
        // Implemente a lógica para resolver o caminho do recurso
        return '/caminho/do/recurso/' . $path;
    }
}

class ViewConfigTest extends TestCase
{
    use ResourcePathTrait;

    /**
     * @codeCoverageIgnore
     */
    public function testViewConfigReturnsExpectedArray()
    {
        // Mockando a função include
        $mockedInclude = $this->getMockBuilder('IncludeMock')
            ->setMethods(['include'])
            ->getMock();

        // Configurando expectativas para a função include
        $mockedInclude->expects($this->once())
            ->method('include')
            ->with($this->equalTo($this->resourcePath('../path/to/your/config/views.php')))
            ->willReturn([
                'paths' => [
                    $this->resourcePath('views'),
                ],
                'compiled' => realpath($this->resourcePath('framework/views')),
            ]);

        // Substituindo a função include real pelo nosso mock
        $this->setIncludeFunction($mockedInclude);

        // Chamando o método ou função que inclui o arquivo
        $config = include $this->resourcePath('../path/to/your/config/views.php');

        // Verificando a configuração
        $this->assertIsArray($config);
        $this->assertArrayHasKey('paths', $config);
        $this->assertArrayHasKey('compiled', $config);
    }

    /**
     * @codeCoverageIgnore
     * Substitui a função include para fins de teste.
     *
     * @param object $mock
     */
    private function setIncludeFunction($mock)
    {
        $namespace = __NAMESPACE__ . '\\';

        eval("namespace $namespace { function include() { global \$__PHPSHADOWER__INCLUDEMOCK__; return \$__PHPSHADOWER__INCLUDEMOCK__->include(...func_get_args()); } }");

        $GLOBALS['__PHPSHADOWER__INCLUDEMOCK__'] = $mock;
    }
}
