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

    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('dashboard');

    Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');

    // Custom Order Routes
    Route::get('/custom-order', [OrderController::class, 'customOrderForm'])->name('custom.order');
    Route::post('/custom-order', [OrderController::class, 'submitCustomOrder'])->name('custom.order.store');

    Route::get('/checkout/retry/{order}', [OrderController::class, 'retry'])->name('checkout.retry');

    // Manual Payment Routes
    Route::get('/payment/manual/{order}', [OrderController::class, 'manualPayment'])->name('payment.manual');
    Route::post('/payment/manual/{order}/process', [OrderController::class, 'processManualPayment'])->name('payment.manual.process');

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
    Route::get('/orders/{order}', [AdminOrderController::class,'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/update-price', [AdminOrderController::class,'updatePrice'])->name('admin.orders.update_price');
    Route::post('/orders/{order}/reject-custom', [AdminOrderController::class,'rejectCustomForm'])->name('admin.orders.reject_form');
    Route::post('/orders/{order}/verify-payment', [AdminOrderController::class,'verifyPayment'])->name('admin.orders.verify_payment');
    Route::post('/orders/{order}/reject-payment', [AdminOrderController::class,'rejectPayment'])->name('admin.orders.reject_payment');
    Route::get('/orders/{order}/cancel', [AdminOrderController::class,'cancel'])->name('admin.orders.cancel');

    // Admin Report (Printable)
    Route::get('/report', [AdminController::class,'report'])->name('admin.report');

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
