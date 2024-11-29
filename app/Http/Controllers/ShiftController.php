<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    //
     // Mostrar todos los turnos
     public function index()
     {
         $shifts = Shift::all();
         return view('shifts.index', compact('shifts'));
     }
 
     // Mostrar el formulario para crear un nuevo turno
     public function create()
     {
         $users = User::all(); // Obtener todos los usuarios
         $weeks = Week::all(); // Obtener todas las semanas
         return view('shifts.create', compact('users', 'weeks'));
     }
 
     // Guardar un nuevo turno
     public function store(Request $request)
     {
         $validated = $request->validate([
             'tipodeturno' => 'required|string',
             'date' => 'required|date',
             'hour' => 'required|date_format:H:i',
             'duration' => 'required|integer|min:1',
             'user_id' => 'required|exists:users,id',
             'week_id' => 'required|exists:weeks,id',
         ]);

          // Obtener la fecha del turno
        $date = Carbon::parse($validated['date']);

        // Buscar o crear la semana en función de la fecha
        $week = Week::firstOrCreate([
            'start_date' => $date->startOfWeek()->format('Y-m-d'), // Primero de la semana
            'month_id' => $date->month, // Asumir que cada semana pertenece al mes correspondiente
        ]);

 
        Shift::create([
            'tipodeturno' => $validated['tipodeturno'],
            'date' => $validated['date'],
            'hour' => $validated['hour'],
            'duration' => $validated['duration'],
            'user_id' => $validated['user_id'],
            'week_id' => $week->id, // Asignar la semana correspondiente
        ]);
        return redirect()->route('shifts.index')->with('success', 'Turno creado correctamente');

     }
 
     // Mostrar el formulario para editar un turno existente
     public function edit(Shift $shift)
     {
         $users = User::all();
         $weeks = Week::all();
         return view('shifts.edit', compact('shift', 'users', 'weeks'));
     }
 
     // Actualizar un turno existente
     public function update(Request $request, Shift $shift)
     {
         $validated = $request->validate([
             'tipodeturno' => 'required|string',
             'date' => 'required|date',
             'hour' => 'required|date_format:H:i',
             'duration' => 'required|integer',
             'user_id' => 'required|exists:users,id',
             'week_id' => 'required|exists:weeks,id',
         ]);
 
         $shift->update($validated);
         return redirect()->route('shifts.index')->with('success', 'Turno actualizado exitosamente.');
     }
 
     // Eliminar un turno
     public function destroy(Shift $shift)
     {
         $shift->delete();
         return redirect()->route('shifts.index')->with('success', 'Turno eliminado exitosamente.');
     }
}
