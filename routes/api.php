<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::get('/images', [ImageController::class, 'index'])->name('image.index');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicle.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/images', [ImageController::class, 'store'])->name('image.store');
    Route::put('/image/{id}', [ImageController::class, 'update'])->name('image.update');
    Route::patch('/image/{id}', [ImageController::class, 'updateStatus'])->name('image.updateImage');
    Route::delete('/image/{id}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation.store');
    Route::put('/reservation/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::patch('/reservation/{id}/status', [ReservationController::class, 'updateStatus'])->name('reservation.updateStatus');
    Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

});


