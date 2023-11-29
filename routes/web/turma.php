<?php

use App\Http\Controllers\Web\Turma\TurmaController;
use Illuminate\Support\Facades\Route;

Route::get('turma', [TurmaController::class, 'listar'])->name('turma.listar');

Route::get('turma/criar', [TurmaController::class, 'criar'])->name('turma.criar');

Route::post('turma', [TurmaController::class, 'salvar'])->name('turma.salvar');

Route::get('turma/editar/{id}', [TurmaController::class, 'editar'])->name('turma.editar');

Route::post('turma/atualizar/{id}', [TurmaController::class,'atualizar'])->name('turma.atualizar');

Route::put('turma/excluir/{id}', [TurmaController::class, 'excluir'])->name('turma.excluir');

Route::put('turma/ativar/{id}', [TurmaController::class, 'ativar'])->name('turma.ativar');

Route::put('turma/desativar/{id}', [TurmaController::class,'desativar',])->name('turma.desativar');
