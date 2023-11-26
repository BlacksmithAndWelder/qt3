<?php
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Http\Requests\Escola\Request as EscolaRequest;

class EscolaRequestTest extends TestCase
{
    public function testValidacaoNomeObrigatorio()
    {
        $validator = Validator::make(['nome' => ''], (new EscolaRequest())->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('O campo Nome é obrigatório.', $validator->errors()->first('nome'));
    }

    public function testValidacaoNomeMaximo256Caracteres()
    {
        $nomeExcedendoLimite = str_repeat('a', 257);

        $validator = Validator::make(['nome' => $nomeExcedendoLimite], (new EscolaRequest())->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('O campo Nome não deve ser maior que 256 caracteres.', $validator->errors()->first('nome'));
    }

    public function testValidacaoEnderecoOpcional()
    {
        $validator = Validator::make(['endereco' => ''], (new EscolaRequest())->rules());

        $this->assertFalse($validator->fails());
    }

    // Adicione testes similares para os outros campos e regras de validação...
}
