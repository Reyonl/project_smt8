<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [PackageController::class, 'index'])->name('home');

Route::get('/packages', [PackageController::class, 'index'])->name('packages');


/*
|--------------------------------------------------------------------------
| USER ROUTES (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');

    // View a single order and retry payment for pending orders
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');

    Route::get('/checkout/retry/{order}', [OrderController::class, 'retry'])->name('checkout.retry');

    // Receive payment result posted from client (Snap onSuccess/onPending/onError)
    Route::post('/payment/result', [OrderController::class, 'paymentResult'])->name('payment.result');

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

    // Admin package resource routes (index, create, store, edit, update, destroy)
    Route::resource('packages', AdminPackageController::class, ['as' => 'admin']);

    Route::get('/orders', [AdminOrderController::class,'index'])->name('admin.orders');

});


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

// Midtrans server-to-server notification (no CSRF token provided by Midtrans)
Route::post('/payment/notification', [OrderController::class, 'notification'])->name('payment.notification');