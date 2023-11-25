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
        // Mocking the include function
        $mockedInclude = $this->getMockBuilder('IncludeMock')
            ->setMethods(['include'])
            ->getMock();

        // Set up expectations for the include function
        $mockedInclude->expects($this->once())
            ->method('include')
            ->with(__DIR__ . '/../path/to/your/config/views.php')
            ->willReturn([
                'paths' => [
                    resource_path('views'),
                ],
                'compiled' => realpath(storage_path('framework/views')),
            ]);

        // Replace the real include function with our mock
        $this->mockFunction('include', $mockedInclude);

        // Call the method or function that includes the file
        $config = include __DIR__ . '/../path/to/your/config/views.php';

        // Verifying the configuration
        $this->assertIsArray($config);
        $this->assertArrayHasKey('paths', $config);
        $this->assertArrayHasKey('compiled', $config);
    }

    /**
     * @codeCoverageIgnore
     * Mock the include function for testing.
     *
     * @param string $functionName
     * @param object $mock
     */
    private function mockFunction($functionName, $mock)
    {
        $namespace = __NAMESPACE__ . '\\';

        eval("namespace $namespace { function $functionName() { global \$__PHPSHADOWER__INCLUDEMOCK__; return \$__PHPSHADOWER__INCLUDEMOCK__->$functionName(...func_get_args()); } }");

        $GLOBALS['__PHPSHADOWER__INCLUDEMOCK__'] = $mock;
    }
}

}
