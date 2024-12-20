<?php

use App\Http\Controllers\MonthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeekController;
use App\Http\Middleware\CheckAdmin;
use App\Models\Week;
use Illuminate\Support\Facades\Request;
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
        Route::resource('shifts', ShiftController::class);
       
    });

});
 // Rutas para el calendario y la gestión de meses (accesible para todos los usuarios autenticados)
 Route::resource('months', MonthController::class);

// Rutas para la gestión de semanas
Route::resource('weeks', WeekController::class);



// Ruta para la vista del calendario (usuarios estándar)
Route::get('/calendar', [ShiftController::class, 'index'])->name('shifts.calendar');


Route::get('/api/weeks', function (Request $request) {
    $monthId = $request->get('month_id');
    $weeks = Week::where('month_id', $monthId)->get();
    return response()->json($weeks);
});
// Ruta para obtener los turnos en formato JSON para el calendario
Route::get('/api/shifts', [ShiftController::class, 'getShifts'])->name('shifts.api');

// Ruta para reservar un turno
Route::post('/shifts/{shift}/reserve', [ShiftController::class, 'reserve'])->name('shifts.reserve');

// Ruta para mostrar el detalle de un turno
Route::get('/shifts/{shift}', [ShiftController::class, 'show'])->name('shifts.show');



Route::get('/contacto', function () {
    return view('pages.contacto');
})->name('contacto');


// Vista Ser Socio 
Route::get('/ser-socio', function () {
return view('pages.serSocio');
})->name('serSocio');





require __DIR__.'/auth.php';
