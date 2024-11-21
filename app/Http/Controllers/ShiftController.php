<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\TypeShift;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Mostrar todos los turnos
    public function index()
    {
        $shift = Shift::with(['typeShift', 'user', 'week'])->get();
        return view('shift.index', compact('shift'));
    }

    /**
     * Show the form for creating a new resource.
     */
      // Mostrar formulario para crear un nuevo turno
      public function create()
      {
          // Cargar usuarios y tipos de turnos
          $users = User::all();
          $typeShift = TypeShift::all();
          $weeks = Week::all();
  
          return view('shift.create', compact('users', 'typeShift', 'weeks'));
      }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('shift.index')->with('success', 'Turno creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
   // Mostrar un turno en particular
   public function show(Shift $shift)
   {
    $shift->load('typeShift', 'user', 'week');
    return view('shift.show', compact('shift'));
   }

    /**
     * Show the form for editing the specified resource.
     */
    // Mostrar formulario para editar un turno
    public function edit(Shift $shift)
    {
        $users = User::all();
        $typeShift = TypeShift::all();
        $weeks = Week::all();

        return view('shift.edit', compact('shift', 'users', 'typeShift', 'weeks'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->route('shift.index')->with('success', 'Turno actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    // Eliminar un turno
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shift.index')->with('success', 'Turno eliminado correctamente.');
    }
}
