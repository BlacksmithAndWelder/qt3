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

        // Mocking the storage_path() function
        $storagePathMock = $this->getMockBuilder('StoragePathMock')
            ->setMethods(['storage_path'])
            ->getMock();

        // Set up expectations for env() function
        $envMock->expects($this->any())
            ->method('env')
            ->willReturnMap([
                ['VIEW_COMPILED_PATH', null, $storagePathMock->storage_path('framework/views')],
            ]);

        // Set up expectations for storage_path() function
        $storagePathMock->expects($this->any())
            ->method('storage_path')
            ->willReturnCallback(function ($path) {
                return realpath(__DIR__ . '/../path/to/your/storage/' . $path);
            });

        // Set up the expected configuration array
        $expectedConfig = [
            'paths' => [
                __DIR__ . '/../path/to/your/views',  // Adjust the path accordingly
            ],
            'compiled' => realpath(__DIR__ . '/../path/to/your/storage/framework/views'),
        ];

        // Include the file to be tested
        $config = include __DIR__ . '/../path/to/your/config/views.php';

        // Verifying the configuration
        $this->assertEquals($expectedConfig, $config);
    }
}
