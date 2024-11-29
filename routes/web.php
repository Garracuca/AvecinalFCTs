<?php

use App\Http\Controllers\MonthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeekController;
use App\Http\Middleware\CheckAdmin;
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

    // Rutas de gestión de usuarios solo para el administrador
    Route::middleware([CheckAdmin::class])->group(function () {
        Route::resource('users', UserController::class);
    });

});
 // Rutas para el calendario y la gestión de meses (accesible para todos los usuarios autenticados)
 Route::resource('months', MonthController::class);

// Rutas para la gestión de semanas
Route::resource('weeks', WeekController::class);


require __DIR__.'/auth.php';
