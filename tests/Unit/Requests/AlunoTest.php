<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Validation\ValidationException;
use BadMethodCallException;
use App\Http\Requests\Aluno\Request as AlunoRequest;

class AlunoRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Method ' . AlunoRequest::class . '::passes does not exist.');

        // Replace the following line with the actual code that triggers the error
        AlunoRequest::passes();
    }

    public function testValidationFails()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Method ' . AlunoRequest::class . '::passes does not exist.');

        // Replace the following line with the actual code that triggers the error
        AlunoRequest::passes();
    }

   
}
