<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
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
Route::patch('update-cart', [ProductController::class, 'update_product'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
Route::delete('remove_all_product', [ProductController::class, 'remove_all_product'])->name('remove_all_product');
Route::delete('delete_many', [ProductController::class, 'delete_many'])->name('delete_many');

Route::get('/admin_products', [ProductController::class, 'admin_products'])->name('admin_products');
Route::get('/export', [ProductController::class, 'export'])->name('products.export');
Route::post('/import', [ProductController::class, 'import'])->name('products.import');