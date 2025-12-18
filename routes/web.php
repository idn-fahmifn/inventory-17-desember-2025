<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// routing admin
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {

    // route dashboard
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    Route::resource('room', RoomController::class);
    Route::resource('item', ItemController::class);

});


// routing petugas
Route::prefix('petugas')->middleware(['auth', 'verified'])->group(function () {

    // route dashboard
    Route::get('/dashboard', [DashboardController::class, 'petugas'])->name('dashboard.petugas');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
