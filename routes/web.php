<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// routing admin
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // route dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});


// routing petugas
Route::prefix('petugas')->middleware(['auth', 'verified'])->group(function () {

    // route dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard.petugas');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
