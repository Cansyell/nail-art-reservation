<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Carbon\Carbon;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/reservation', [FrontController::class, 'reservation'])->name('reservation');
Route::get('/reservation/finish', [FrontController::class, 'finish'])->name('reservation.finish');
Route::post('/book-appointment', [ReservationController::class, 'book'])->name('book.appointment');

Route::get('/dashboard', function () {
    $reservations = Transaction::where('payment_status', 'paid')
    ->whereYear('created_at', now()->year)
    ->get()
    ->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('m');
    })
    ->map(function($group) {
        return $group->count();
    });

// Prepare data for chart
$months = [];
$reservationCounts = [];

// Ensure all months are represented
for ($i = 1; $i <= 12; $i++) {
    $monthKey = str_pad($i, 2, '0', STR_PAD_LEFT);
    $months[] = Carbon::create()->month($i)->format('F');
    $reservationCounts[] = $reservations->get($monthKey, 0);
}

return view('dashboard', compact('months', 'reservationCounts'));
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
