<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::post('/products/store', [ProductController::class, 'products_store'])->name('products_store');
Route::get('/products/show/{id}', [ProductController::class, 'products_show'])->name('products_show');
Route::put('/products/update/{id}', [ProductController::class,'products_update'])->name('products_update');
Route::delete('/products/delete/{id}', [ProductController::class, 'products_delete'])->name('products_delete');