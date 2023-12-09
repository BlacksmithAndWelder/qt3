<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Http\Requests\SuporteTarefaStatus\Request;

class SuporteTarefaStatusRequestTest extends TestCase
{
    /** @test */
    public function it_has_correct_validation_rules()
    {
        $request = new Request();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'nome' => 'required|string|max:20|in:Aberto,Inconsistente,Solucionado,Recusado',
        ], $request->rules());
    }

    /** @test */
    public function it_has_correct_attributes()
    {
        $request = new Request();

        $this->assertEquals([
            'nome' => 'Nome',
        ], $request->attributes());
    }
}
