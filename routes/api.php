<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('clientes', [ClientController::class, 'index']);
Route::get('clientes/{id}', [ClientController::class, 'show']);
Route::post('clientes', [ClientController::class, 'create']);
Route::put('clientes/{id}', [ClientController::class, 'update']);
Route::delete('clientes/{id}', [ClientController::class, 'delete']);

Route::get('produtos', [ProductController::class, 'index']);
Route::get('produtos/{id}', [ProductController::class, 'show']);
Route::post('produtos', [ProductController::class, 'create']);
Route::put('produtos/{id}', [ProductController::class, 'update']);
Route::delete('produtos/{id}', [ProductController::class, 'delete']);

Route::get('pedidos', [OrderController::class, 'index']);
Route::post('pedidos', [OrderController::class, 'create']);
Route::get('pedidos/{id}', [OrderController::class, 'show']);
Route::put('pedidos/{id}', [OrderController::class, 'update']);
Route::delete('pedidos/{id}', [OrderController::class, 'delete']);

Route::post('pedidos/{id}/sendmail', [OrderController::class, 'mail']);
Route::get('pedidos/{id}/report', [OrderController::class, 'report']);
