<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use Illuminate\Database\Capsule\Manager as DB;

class SuporteTarefaControllerTest extends TestCase
{
    public function testListarFunction()
    {
        // Create an instance of the controller
        $controller = new SuporteTarefaController();

        // Use the Eloquent Capsule Manager to set up a minimal database for testing
        $capsule = new DB;
        $capsule->addConnection([
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        // Perform any necessary database migrations or seeding
        // ...

        // Call the listar method
        $response = $controller->listar();

        // Assert that the view is not empty
        $this->assertNotEmpty($response->getData()['ListaSuporteTarefa']);
    }
}
