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
             return view('shifts.index', compact('shifts'));
         } else {
             $shifts = Shift::where('completed', false)->get(); // Usuarios estándar ven solo turnos disponibles
             return view('shifts.calendar', compact('shifts')); // Redirige a una vista exclusiva de calendario
         }
     }
 
     // Mostrar el formulario para crear un nuevo turno
     public function create(Request $request)
     {
         $selectedDate = $request->get('date', now()->format('Y-m-d')); // Fecha seleccionada o actual
         $months = Month::all();
         $users = User::all();
     
         // Calcular la semana correspondiente a la fecha seleccionada
         $week = Week::firstOrCreate([
             'start_date' => Carbon::parse($selectedDate)->startOfWeek(),
             'month_id' => Carbon::parse($selectedDate)->month,
         ]);
     
         // Todas las semanas del mes actual para el formulario
         $weeks = Week::where('month_id', $week->month_id)->get();
     
         return view('shifts.create', compact('months', 'weeks', 'users', 'selectedDate', 'week'));
     }
     
    public function show(Shift $shift)
    {
        // Retorna la vista con los detalles del turno seleccionado
        return view('shifts.show', compact('shift'));
    }

 
     // Guardar un nuevo turno
     public function store(Request $request)
     {
         $validated = $request->validate([
            'tipodeturno' => 'required|string',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1',
         ]);
          // Calcular semana automáticamente
    $week = Week::firstOrCreate([
        'start_date' => Carbon::parse($validated['date'])->startOfWeek(),
        'month_id' => Carbon::parse($validated['date'])->month,
    ]);
     
        // Crear el turno
    Shift::create([
        'tipodeturno' => $validated['tipodeturno'],
        'date' => $validated['date'],
        'hour' => $validated['hour'],
        'duration' => $validated['duration'],
        'user_id' => null, // Sin asignar usuario al crear
        'completed' => false, // Turno libre
        'week_id' => $week->id,
    ]);
     
         return redirect()->route('shifts.index')->with('success', 'Turno creado como disponible.');
     }
 
     // Mostrar el formulario para editar un turno existente
     public function edit(Shift $shift)
{
    $users = User::all(); // Obtener todos los usuarios para el formulario

    // Calcular dinámicamente el mes al que pertenece la fecha del turno
    $month = Month::where('start_date', '<=', $shift->date)
        ->whereRaw("DATE_ADD(start_date, INTERVAL 1 MONTH) > ?", [$shift->date]) // Verifica que la fecha esté dentro del rango del mes
        ->first();

    if (!$month) {
        return redirect()->back()->with('error', 'No se encontró el mes correspondiente a la fecha del turno.');
    }

    // Obtener las semanas asociadas al mes encontrado
    $weeks = Week::where('month_id', $month->id)->get();

    return view('shifts.edit', compact('shift', 'users', 'month', 'weeks'));
}

 
     // Actualizar un turno existente
     public function update(Request $request, Shift $shift)
        {
            $validated = $request->validate([
                'tipodeturno' => 'required|string',
                'date' => 'required|date',
                'hour' => 'required|date_format:H:i',
                'duration' => 'required|integer|min:1',
                'user_id' => 'nullable|exists:users,id',
            ]);

            // Calcular nueva semana si cambia la fecha
            $week = Week::firstOrCreate([
                'start_date' => Carbon::parse($validated['date'])->startOfWeek(),
                'month_id' => Carbon::parse($validated['date'])->month,
            ]);

            // Determinar si el turno debe estar completado (ocupado)
            $isCompleted = !is_null($validated['user_id']);

            $shift->update([
                'tipodeturno' => $validated['tipodeturno'],
                'date' => $validated['date'],
                'hour' => $validated['hour'],
                'duration' => $validated['duration'],
                'user_id' => $validated['user_id'],
                'week_id' => $week->id,
                'completed' => $isCompleted,
            ]);

            return redirect()->route('shifts.index')->with('success', 'Turno actualizado correctamente.');
        }
            
         
 
     // Eliminar un turno
     public function destroy(Shift $shift)
     {
         $shift->delete();
         return redirect()->route('shifts.index')->with('success', 'Turno eliminado exitosamente.');
     }

     // Valida que el turno esté disponible antes de reservarlo.
     //Asocia el turno al usuario autenticado.

     public function reserve(Shift $shift)
     {
         // Verificar si el turno ya está reservado o completado
         if ($shift->completed || $shift->user_id) {
             return redirect()->route('shifts.calendar')->with('error', 'Este turno ya está reservado.');
         }
     
         // Actualizar el turno con el usuario autenticado y marcar como reservado
         $shift->update([
             'user_id' => auth()->id(),
             'completed' => true,
         ]);
     
         // Redirigir al calendario con un mensaje de éxito
         return redirect()->route('shifts.calendar')->with('success', 'Turno reservado con éxito.');
     }
     


    /**
 * Obtener turnos en formato JSON para el calendario.
 * Devuelve los turnos en un formato que FullCalendar puede procesar.
 */
public function getShifts()
{
    $shifts = Shift::with('user') // Cargar la relación con el usuario
        ->select(['id', 'date', 'hour', 'duration', 'tipodeturno', 'completed', 'user_id'])
        ->get()
        ->map(function ($shift) {
            $status = $shift->completed ? 'ocupado' : ($shift->user_id ? 'pendiente' : 'disponible');
            $color = match ($status) {
                'disponible' => 'green',
                'pendiente' => 'orange',
                'ocupado' => 'red',
            };

            return [
                'id' => $shift->id,
                'title' => ucfirst($shift->tipodeturno) . ' (' . $shift->hour . ')',
                'start' => $shift->date . 'T' . $shift->hour,
                'color' => $shift->completed ? 'red' : 'green',
                'extendedProps' => [
                    'status' => $shift->completed ? 'ocupado' : 'disponible',
                    'user' => $shift->user ? $shift->user->name : null,
                ],
            ];
        });

    return response()->json($shifts);
}


    public function copyWeekToMonth(Request $request)
{
    $validated = $request->validate([
        'source_week_id' => 'required|exists:weeks,id',
        'target_month_id' => 'required|exists:months,id',
    ]);

    $sourceWeek = Week::find($validated['source_week_id']);
    $targetMonth = Month::find($validated['target_month_id']);

    if (!$sourceWeek || !$targetMonth) {
        return redirect()->back()->with('error', 'Semana o mes no encontrado.');
    }

    // Crear una nueva semana en el mes objetivo
    $newWeek = Week::create([
        'start_date' => Carbon::parse($sourceWeek->start_date)->startOfMonth()->addDays(7 * $targetMonth->id)->format('Y-m-d'),
        'month_id' => $targetMonth->id,
    ]);

    // Copiar los turnos
    foreach ($sourceWeek->shifts as $shift) {
        Shift::create([
            'tipodeturno' => $shift->tipodeturno,
            'date' => Carbon::parse($shift->date)->addWeeks($targetMonth->id)->format('Y-m-d'),
            'hour' => $shift->hour,
            'duration' => $shift->duration,
            'user_id' => null,
            'completed' => false,
            'week_id' => $newWeek->id,
        ]);
    }

    return redirect()->route('shifts.index')->with('success', 'Turnos copiados exitosamente.');
}



}
