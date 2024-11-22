<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\TypeShift;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    // Mostrar todos los turnos
    public function index()
    {
        // Cargar turnos con sus relaciones
        $shifts = Shift::with(['typeShift', 'user', 'week'])->get();
        return view('shifts.index', ['shifts' => $shifts]);
    }

    // Mostrar formulario para crear un nuevo turno
    public function create()
    {
        $users = User::all();
        $typeShifts = TypeShift::all();
        $weeks = Week::all();

        return view('shifts.create', compact('users', 'typeShifts', 'weeks'));
    }

    // Guardar un nuevo turno
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_shift_id' => 'required|exists:type_shift,id',
            'date' => 'required|date',
            'hour' => 'required',
            'duration' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'week_id' => 'required|exists:weeks,id',
        ]);

        Shift::create($validatedData);

        return redirect()->route('shifts.index')->with('success', 'Shift created successfully.');
    }

    // Mostrar un turno en particular
    public function show(Shift $shift)
    {
        $shift->load('typeShift', 'user', 'week');
        return view('shifts.show', compact('shift'));
    }

    // Mostrar formulario para editar un turno
    public function edit(Shift $shift)
    {
        $users = User::all();
        $typeShifts = TypeShift::all();
        $weeks = Week::all();

        return view('shifts.edit', compact('shift', 'users', 'typeShifts', 'weeks'));
    }

    // Actualizar un turno
    public function update(Request $request, Shift $shift)
    {
        $validatedData = $request->validate([
            'type_shift_id' => 'required|exists:type_shift,id',
            'date' => 'required|date',
            'hour' => 'required',
            'duration' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'week_id' => 'required|exists:weeks,id',
        ]);

        $shift->update($validatedData);

        return redirect()->route('shifts.index')->with('success', 'Shift updated successfully.');
    }

    // Eliminar un turno
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shifts.index')->with('success', 'Shift deleted successfully.');
    }

    // API para obtener turnos en formato JSON (compatible con FullCalendar)
    public function shiftsApi()
    {
        $shifts = Shift::with('user', 'typeShift')
            ->get()
            ->map(function ($shift) {
                return [
                    'id' => $shift->id,
                    'title' => $shift->typeShift->name . ' - ' . optional($shift->user)->name,
                    'start' => $shift->date . 'T' . $shift->hour,
                    'end' => $shift->date . 'T' . date('H:i', strtotime($shift->hour) + $shift->duration * 3600),
                ];
            });

        return response()->json($shifts);
    }
}
