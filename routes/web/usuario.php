<?php

use App\Http\Controllers\Web\Usuario\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('usuario', [UsuarioController::class, 'listar'])->name('usuario.listar');

Route::get('usuario/criar', [UsuarioController::class, 'criar'])->name('usuario.criar');

Route::post('usuario', [UsuarioController::class, 'salvar'])->name('usuario.salvar');

Route::get('usuario/editar/{id}', [UsuarioController::class, 'editar'])->name('usuario.editar');

Route::post('usuario/atualizar/{id}', [UsuarioController::class,'atualizar'])->name('usuario.atualizar');

Route::put('usuario/excluir/{id}', [UsuarioController::class, 'excluir'])->name('usuario.excluir');

