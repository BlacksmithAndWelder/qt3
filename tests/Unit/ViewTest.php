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
        // Mocking the env() function
        $envMock = $this->getMockBuilder('EnvMock')
            ->setMethods(['env'])
            ->getMock();
        
        // Set up expectations for env() function
        $envMock->expects($this->any())
            ->method('env')
            ->willReturnMap([
                ['VIEW_COMPILED_PATH', null, realpath(storage_path('framework/views'))],
            ]);

        // Set up the expected configuration array
        $expectedConfig = [
            'paths' => [
                resource_path('views'),
            ],
            'compiled' => realpath(storage_path('framework/views')),
        ];

        // Include the file to be tested
        $config = include 'qt3/config/views.php';

        // Verifying the configuration
        $this->assertEquals($expectedConfig, $config);
    }
}
