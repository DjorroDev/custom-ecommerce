<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sales', [OrderController::class, 'index'])->middleware(['auth','verified'])->name('sales');
Route::put('/sales/{order}', [OrderController::class,'update'])->middleware(['auth','verified']);
Route::post('/sales/log/{orderId}', [LogController::class,'createLogForOrder'])->middleware(['auth','verified']);

Route::post('/upload-image',[OrderController::class,'uploadImage']);

Route::get('shipment', function () {
    return Inertia::render('shipment/Delivery');
})->middleware(['auth','verified'])->name('shipment');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/shop', function () {
    return Inertia::render('shop/ginseng');
});

require __DIR__.'/auth.php';
