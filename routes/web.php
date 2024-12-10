<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/reservation', [FrontController::class, 'reservation'])->name('reservation');
Route::post('/book-appointment', [ReservationController::class, 'book'])->name('book.appointment');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/{service}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
    
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');

});

require __DIR__.'/auth.php';
