<?php

use App\Http\Requests\SuporteTarefaStatus\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testAuthorize()
    {
        $request = new Request();

        // Mocking the return value of the authorize method
        $this->assertTrue($request->authorize());
    }

    public function testRules()
    {
        $request = new Request();

        // Mocking input data
        $requestData = [
            'nome' => 'Aberto',
        ];

        $this->assertEquals([], $request->rules()); // No need to test the rules method itself, it's Laravel's responsibility

        // You can use Laravel's built-in validation to test the rules
        $validator = validator($requestData, $request->rules());
        $this->assertTrue($validator->passes());
    }

    public function testAttributes()
    {
        $request = new Request();

        // Mocking the return value of the attributes method
        $this->assertEquals(['nome' => 'Nome'], $request->attributes());
    }
}
