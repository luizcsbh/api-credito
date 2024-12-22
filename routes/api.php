<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ModalidadeController;
use App\Http\Controllers\ClienteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/clientes', ClienteController::class);

Route::get('/instituicoes', [InstituicaoController::class, 'index']);
Route::get('/instituicoes/{id}', [InstituicaoController::class, 'show']);

Route::resource('/modalidades', ModalidadeController::class)->only(['index', 'show']);
Route::resource('/modalidades', ModalidadeController::class)->except(['create', 'edit']);

Route::prefix('simulacao')->group(function () {
    Route::post('/credito', [CreditoController::class, 'credito']);
    Route::post('/simula-oferta', [CreditoController::class, 'simulaOferta']);
});