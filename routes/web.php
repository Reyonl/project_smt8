<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderInvoiceController;
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
    Route::post('/checkout/{order}/notes', [OrderController::class, 'saveNotesAwal'])->name('checkout.notes');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/orders/{order}/invoice', [OrderInvoiceController::class, 'download'])->name('order.invoice');
    
    // User Brief Project Routes
    Route::get('/orders/{order}/brief', [OrderController::class, 'briefForm'])->name('order.brief.form');
    Route::post('/orders/{order}/brief', [OrderController::class, 'submitBrief'])->name('order.brief.submit');

    // Custom Order Routes
    Route::get('/custom-order', [OrderController::class, 'customOrderForm'])->name('custom.order');
    Route::post('/custom-order', [OrderController::class, 'submitCustomOrder'])->name('custom.order.store');

    Route::get('/checkout/retry/{order}', [OrderController::class, 'retry'])->name('checkout.retry');

    // Dummy Payment Gateway Routes
    Route::post('/payment/simulate/{order}', [OrderController::class, 'simulateGateway'])->name('payment.simulate');
    Route::post('/payment/process/{order}', [OrderController::class, 'processPayment'])->name('payment.process');

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
    Route::put('/orders/{order}/cancel', [AdminOrderController::class,'cancel'])->name('admin.orders.cancel');
    Route::put('/orders/{order}/update-stage', [AdminOrderController::class,'updateStage'])->name('admin.orders.update_stage');
    Route::post('/orders/{order}/assets', [\App\Http\Controllers\Admin\AdminOrderAssetController::class, 'upload'])->name('admin.orders.assets.upload');

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
    
    // Notification Route
    Route::post('/notifications/read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.read');

    // Project Hub Routes
    Route::post('/orders/{order}/discussions', [\App\Http\Controllers\ProjectHubController::class, 'sendMessage'])->name('order.discussion.send');
    Route::get('/assets/{asset}/download', [\App\Http\Controllers\ProjectHubController::class, 'downloadAsset'])->name('order.asset.download');

});

require __DIR__.'/auth.php';