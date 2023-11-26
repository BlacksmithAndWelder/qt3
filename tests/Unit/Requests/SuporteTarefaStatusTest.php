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

    

    public function testAttributes()
    {
        $request = new Request();

        // Mocking the return value of the attributes method
        $this->assertEquals(['nome' => 'Nome'], $request->attributes());
    }
}
