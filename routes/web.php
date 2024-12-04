<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


Route::post('/checkout', [OrderController::class, 'storeT'])->name('checkout');

Route::get('/checkout/{order_code}', [OrderController::class, 'checkoutPayment'])->name('checkout_payment');
Route::get('/checkoutlagi', [OrderController::class, 'processPayment'])->name('process_payment');

Route::get('/', [HomeController::class, 'home'])->name('home'); 

route:: post('/payment/{order_code}', [OrderController::class, 'uploadPayment'])->name('payment');


Route::get('/products/{id}', [ProductController::class, 'product']); 

Route::get('/carts', [CartController::class, 'cart'])->name('carts');

Route::get('/carts/product/{id}', [CartController::class, 'store']);



require __DIR__.'/auth.php';
