<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

// Rota para iniciar a autenticação com o Google
Route::get('/auth/google', [GoogleController::class, 'redirect']);

// Rota de callback após a autenticação do Google
Route::get('/auth/callback', [GoogleController::class, 'login']);
