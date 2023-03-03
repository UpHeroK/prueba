<?php

use App\Http\Controllers\NivelController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group([
    'prefix' => 'afiliados',
], function () {
    Route::get('/niveles', [NivelController::class, 'index']);
    Route::post('/nivel', [NivelController::class, 'store']);
    Route::get('/nivel/{id}', [NivelController::class, 'show']);
    Route::put('/nivel/{id}', [NivelController::class, 'update']);
    Route::delete('/nivel/{id}', [NivelController::class, 'destroy']);

    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::post('/usuario', [UsuarioController::class, 'store']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
    Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);

});
