<?php

use App\Http\Controllers\Web\Aluno\AlunoController;
use Illuminate\Support\Facades\Route;

Route::get('aluno', [AlunoController::class, 'listar'])->name('aluno.listar');

Route::get('aluno/criar', [AlunoController::class, 'criar'])->name('aluno.criar');

Route::post('aluno', [AlunoController::class, 'salvar'])->name('aluno.salvar');

Route::get('aluno/editar/{id}', [AlunoController::class, 'editar'])->name('aluno.editar');

Route::post('aluno/atualizar/{id}', [AlunoController::class,'atualizar'])->name('aluno.atualizar');

Route::put('aluno/excluir/{id}', [AlunoController::class, 'excluir'])->name('aluno.excluir');

