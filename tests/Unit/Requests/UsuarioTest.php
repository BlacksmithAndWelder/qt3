<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\Usuario\Request as UsuarioRequest;

class UsuarioRequestTest extends TestCase
{
    public function testValidationRules()
    {
        $request = new UsuarioRequest();

        $this->assertTrue($request->authorize()); // Ensure authorization is true

        $rules = $request->rules();

        $this->assertArrayHasKey('nome', $rules);
        $this->assertArrayHasKey('senha', $rules);
        $this->assertArrayHasKey('email', $rules);

        $this->assertEquals('required', $rules['nome']);
        $this->assertEquals('required', $rules['senha']);
        $this->assertEquals('required', $rules['email']);
    }

    public function testAttributes()
    {
        $request = new UsuarioRequest();

        $attributes = $request->attributes();

        $this->assertEquals('Nome', $attributes['nome']);
        $this->assertEquals('Senha', $attributes['senha']);
        $this->assertEquals('Email', $attributes['email']);
    }
}
