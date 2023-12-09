<?php

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Web\Aluno\AlunoController;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoControllerTest extends TestCase
{
    public function testListar()
    {
        $controller = new AlunoController();
        $response = $controller->listar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
    }

    public function testCriar()
    {
        $controller = new AlunoController();
        $response = $controller->criar();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
    }

    public function testSalvar()
    {
        $request = new AlunoRequest([
            'nome' => 'TesteNome',
            'sobrenome' => 'TesteSobrenome',
            'idade' => 25,
            'bolsa_estudos' => true,
            'turma_id' => 1,
        ]);

        $controller = new AlunoController();
        $response = $controller->salvar($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
    }

    // Adicione testes para as outras funções (editar, atualizar, excluir) de acordo com a lógica do seu código.

    // ...

}
