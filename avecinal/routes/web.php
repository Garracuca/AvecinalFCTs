<?php

use App\Http\Controllers\MonthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeekController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para la gestión de usuarios
Route::resource('users', UserController::class);

// Rutas para la gestión de semanas
Route::resource('weeks', WeekController::class);

// Rutas para la gestión de meses
Route::resource('months', MonthController::class);

require __DIR__.'/auth.php';
