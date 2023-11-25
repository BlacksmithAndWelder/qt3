<?php

namespace Tests\Unit;
use PHPUnit\Framework\TestCase;

/**
 * @codeCoverageIgnore
 */
class ViewConfigTest extends TestCase
{
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
            ->with($this->equalTo(__DIR__ . '/../path/to/your/config/views.php'))
            ->willReturn([
                'paths' => [
                    resource_path('views'),
                ],
                'compiled' => realpath(storage_path('framework/views')),
            ]);

        // Substituindo a função include real pelo nosso mock
        $this->setIncludeFunction($mockedInclude);

        // Chamando o método ou função que inclui o arquivo
        $config = include __DIR__ . '/../path/to/your/config/views.php';

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
