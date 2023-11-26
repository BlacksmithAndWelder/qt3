<?php
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;
use App\Http\Requests\Escola\Request;

class EscolaRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $request = new Request([
            'nome' => 'Escola Teste',
            'endereco' => 'Rua Teste, 123',
            'pais' => 'Brasil',
            'max_alunos' => 100,
            'segmento' => 'Ensino Fundamental',
        ]);

        $this->assertTrue($request->passes());
    }

    public function testValidationFailsWithMissingRequiredFields()
    {
        $request = new Request([]);

        try {
            $request->validate();
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('nome', $e->errors());
            $this->assertArrayHasKey('segmento', $e->errors());
            $this->assertCount(2, $e->errors());
            return;
        }

        $this->fail('ValidationException should have been thrown.');
    }

    public function testAttributes()
    {
        $request = new Request([]);

        $this->assertEquals('Nome', $request->attributes()['nome']);
        $this->assertEquals('Segmento', $request->attributes()['segmento']);
        $this->assertEquals('Endereço', $request->attributes()['endereco']);
        $this->assertEquals('País', $request->attributes()['pais']);
        $this->assertEquals('Quantidade máxima de alunos', $request->attributes()['max_alunos']);
    }
}
