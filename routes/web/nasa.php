<?php

use App\Http\Controllers\Web\Nasa\NasaController;
use Illuminate\Support\Facades\Route;

Route::get('nasa', [NasaController::class, 'detalhe'])->name('nasa.detalhe');

