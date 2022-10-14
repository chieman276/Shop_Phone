<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
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

Route::get('/loginvv', function () {
    return view('login');
});

Route::get('/frontend', function () {
    return view('frontend.layouts.master');
});

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/post_login', [LoginController::class, 'post_login'])->name('post_login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/post_register', [RegisterController::class, 'post_register'])->name('post_register');
Route::get('/website/product', [ProductController::class, 'websiteProduct'])->name('websiteProduct');
// Route::post('/website/add_to_cart', [ProductController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/website/showProduct/{id}', [ProductController::class, 'showProduct'])->name('showProduct');
// Route::get('cart', [ProductController::class, 'cart'])->name('cart');
// Route::patch('updateQuantity-cart', [ProductController::class, 'updateQuantity'])->name('update.cart');

Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/orders', [ProductController::class, 'orders'])->name('orders');
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');