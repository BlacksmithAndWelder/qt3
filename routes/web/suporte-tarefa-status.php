<?php

use App\Http\Controllers\Web\Suporte\SuporteTarefaStatusController;
use Illuminate\Support\Facades\Route;

Route::get('suporte-tarefa-status', [
    SuporteTarefaStatusController::class,
     'listar'
     ])->name('suporte-tarefa-status.listar');

Route::get('suporte-tarefa-status/criar', [
    SuporteTarefaStatusController::class,
     'criar'
     ])->name('suporte-tarefa-status.criar');

Route::post('suporte-tarefa-status', [
    SuporteTarefaStatusController::class,
     'salvar'
     ])->name('suporte-tarefa-status.salvar');

Route::get('suporte-tarefa-status/editar/{id}', [
    SuporteTarefaStatusController::class,
     'editar'
     ])->name('suporte-tarefa-status.editar');

Route::post('suporte-tarefa-status/atualizar/{id}', [
    SuporteTarefaStatusController::class,
    'atualizar'
    ])->name('suporte-tarefa-status.atualizar');

Route::put('suporte-tarefa-status/excluir/{id}', [
    SuporteTarefaStatusController::class,
     'excluir'
     ])->name('suporte-tarefa-status.excluir');
