<?php

namespace Tests\Feature;

use App\Http\Controllers\Web\Aluno\AlunoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlunoControllerTest extends TestCase
{
    /**
     * Test if the listar route returns a 200 status code.
     *
     * @return void
     */
    public function testListarRoute()
    {
        $this->get('aluno')->assertStatus(200);
    }

    /**
     * Test if the criar route returns a 200 status code.
     *
     * @return void
     */
    public function testCriarRoute()
    {
        $this->get('aluno/criar')->assertStatus(200);
    }

    /**
     * Test if the salvar route returns a 200 status code.
     *
     * @return void
     */
    public function testSalvarRoute()
    {
        $this->post('aluno')->assertStatus(200);
    }

    /**
     * Test if the editar route returns a 200 status code.
     *
     * @return void
     */
    public function testEditarRoute()
    {
        $this->get('aluno/editar/1')->assertStatus(200);
    }

    /**
     * Test if the atualizar route returns a 200 status code.
     *
     * @return void
     */
    public function testAtualizarRoute()
    {
        $this->post('aluno/atualizar/1')->assertStatus(200);
    }

    /**
     * Test if the excluir route returns a 200 status code.
     *
     * @return void
     */
    public function testExcluirRoute()
    {
        $this->put('aluno/excluir/1')->assertStatus(200);
    }
}

