<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ModalidadeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteInstituicaoController;

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
Route::resource('/instituicoes', InstituicaoController::class);
Route::resource('/modalidades', ModalidadeController::class);
Route::resource('/clienteinstituicoes', ClienteInstituicaoController::class);


Route::prefix('simulacao')->group(function () {
    Route::post('/credito', [CreditoController::class, 'credito']);
    Route::post('/simula-oferta', [CreditoController::class, 'simulaOferta']);
});