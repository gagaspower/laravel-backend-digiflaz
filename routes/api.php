<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DigiflazController;
use App\Http\Controllers\Api\ProductController;
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



Route::post(
    '/auth/login',
    [AuthController::class, 'AuthLogin']
);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post(
        '/auth/logout',
        [AuthController::class, 'AuthLogout']
    );

    Route::controller(DigiflazController::class)->prefix('digiflaz')->group(function () {
        Route::post('/get-product-prepaid', 'get_product_prepaid');
        Route::post('/get-product-pasca', 'get_product_pasca');
        Route::post('/topup', 'digiflazTopup');
        Route::post('/cek-tagihan', 'digiflazCekTagihan');
        Route::post('/bayar-tagihan', 'digiflazBayarTagihan');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::post('/get-product-pulsa', 'index');
    });
});
