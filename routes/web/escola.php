<?php

use App\Http\Controllers\Web\Escola\EscolaController;
use Illuminate\Support\Facades\Route;

Route::get('escola', [EscolaController::class, 'listar'])->name('escola.listar');

Route::get('escola/criar', [EscolaController::class, 'criar'])->name('escola.criar');

Route::post('escola', [EscolaController::class, 'salvar'])->name('escola.salvar');

Route::get('escola/editar/{id}', [EscolaController::class, 'editar'])->name('escola.editar');

Route::post('escola/atualizar/{id}', [EscolaController::class,'atualizar'])->name('escola.atualizar');

Route::put('escola/excluir/{id}', [EscolaController::class, 'excluir'])->name('escola.excluir');

