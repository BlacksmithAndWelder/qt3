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

   