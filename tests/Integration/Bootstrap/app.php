<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;

class IntegrationTest extends TestCase
{
    /** @test */
    public function it_binds_important_interfaces()
    {
        // Create the application instance
        $app = require __DIR__ . '/../bootstrap/app.php';

        // Resolve and assert the HTTP Kernel binding
        $httpKernel = $app->make(Kernel::class);
        $this->assertInstanceOf(App\Http\Kernel::class, $httpKernel);

        // Resolve and assert the Console Kernel binding
        $consoleKernel = $app->make(ConsoleKernel::class);
        $this->assertInstanceOf(App\Console\Kernel::class, $consoleKernel);

        // Resolve and assert the ExceptionHandler binding
        $exceptionHandler = $app->make(ExceptionHandler::class);
        $this->assertInstanceOf(App\Exceptions\Handler::class, $exceptionHandler);
    }
}
