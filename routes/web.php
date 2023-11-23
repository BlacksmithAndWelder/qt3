<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

require 'web/escola.php';
require 'web/turma.php';
require 'web/aluno.php';
require 'web/suporte-tarefa-status.php';
require 'web/suporte-tarefa.php';
require 'web/usuario.php';
require 'web/nasa.php';
// require 'web/escola.php';

