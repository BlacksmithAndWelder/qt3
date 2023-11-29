<?php

use App\Http\Controllers\Web\Suporte\SuporteTarefaController;
use Illuminate\Support\Facades\Route;

Route::get('suporte-tarefa', [SuporteTarefaController::class, 'listar'])->name('suporte-tarefa.listar');

Route::get('suporte-tarefa/criar', [SuporteTarefaController::class, 'criar'])->name('suporte-tarefa.criar');

Route::post('suporte-tarefa', [SuporteTarefaController::class, 'salvar'])->name('suporte-tarefa.salvar');

Route::get('suporte-tarefa/editar/{id}', [SuporteTarefaController::class, 'editar'])->name('suporte-tarefa.editar');

Route::post('suporte-tarefa/atualizar/{id}', [SuporteTarefaController::class,'atualizar'])->name('suporte-tarefa.atualizar');

Route::put('suporte-tarefa/excluir/{id}', [SuporteTarefaController::class, 'excluir'])->name('suporte-tarefa.excluir');

