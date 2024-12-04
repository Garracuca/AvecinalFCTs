<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Month;
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
        if (auth()->user()->rol === 'admin') {
            $shifts = Shift::all(); // Admin ve todos los turnos
        } else {
            $shifts = Shift::where('completed', false)->get(); // Usuario estándar ve solo turnos disponibles
        }
    
        return view('shifts.index', compact('shifts'));
     }
 
     // Mostrar el formulario para crear un nuevo turno
     public function create()
     {
        $months = Month::all();
         $users = User::all(); // Obtener todos los usuarios
         $weeks = Week::all(); // Obtener todas las semanas
         return view('shifts.create', compact('months', 'weeks', 'users'));
    }
 
     // Guardar un nuevo turno
     public function store(Request $request)
     {
         $validated = $request->validate([
            'month_id' => 'required|exists:months,id',
            'week_id' => 'required|exists:weeks,id',
            'tipodeturno' => 'required|string',
             'date' => 'required|date',
             'hour' => 'required|date_format:H:i',
             'duration' => 'required|integer|min:1',
             'user_id' => 'required|exists:users,id',
             
        ]);

          // Obtener la fecha del turno
        //$date = Carbon::parse($validated['date']);

        $week = Week::firstOrCreate([
            'start_date' => Carbon::parse($validated['date'])->startOfWeek()->format('Y-m-d'),
            'month_id' => Carbon::parse($validated['date'])->month,
        ]);

 
        $shift = Shift::create([
            'tipodeturno' => $request->tipodeturno,
            'date' => $request->date,
            'hour' => $request->hour,
            'duration' => $request->duration,
            'user_id' => $request->user_id,
            'week_id' => $request->week_id,
        ]);

        return redirect()->route('shifts.index')->with('success', 'Turno creado con éxito');
    
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

     public function reserve(Shift $shift)
    {
        if ($shift->completed) {
            return redirect()->route('shifts.index')->with('error', 'Este turno ya está reservado.');
        }

        $shift->update(['completed' => true, 'user_id' => auth()->id()]);
        return redirect()->route('shifts.index')->with('success', 'Turno reservado con éxito.');
    }

}
